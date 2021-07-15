@extends('layouts.master')

@section('title')
	Blog detail
@endsection

@section('content')
	
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="{{ route('index') }}" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="{{ route('blog') }}" class="stext-109 cl8 hov-cl1 trans-04">
				Blog
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				{{ $post->title }}
			</span>
		</div>
	</div>


	<!-- Content page -->
	<section class="bg0 p-t-52 p-b-20">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-45 p-r-0-lg">
						<!--  -->
						<div class="wrap-pic-w how-pos5-parent">
							<img src="{{ asset($post->image) }}" alt="IMG-BLOG">

							<div class="flex-col-c-m size-123 bg9 how-pos5">
								<span class="ltext-107 cl2 txt-center">
									{{ date_format(new DateTime($post->created_at), 'd') }}
								</span>

								<span class="stext-109 cl3 txt-center">
									{{ date_format(new DateTime($post->created_at), 'm-Y') }}
								</span>
							</div>
						</div>

						<div class="p-t-32">
							<span class="flex-w flex-m stext-111 cl2 p-b-19">
								<span>
									<span class="cl4">By</span> {{ $post->user->name }}  
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									{{ $post->created_at->toFormattedDateString() }}
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									@foreach ($post->tags as $tag)
										{{ $tag->name }}, &nbsp;
									@endforeach 
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									{{ $post->comments->count() }} Comments
								</span>
							</span>

							<h4 class="ltext-109 cl2 p-b-28">
								{{ $post->title }}
							</h4>

							<p class="stext-117 cl6 p-b-26">
								{!! $post->content !!}
							</p>


						</div>

						<div class="flex-w flex-t p-t-16">
							<span class="size-216 stext-116 cl8 p-t-4">
								Tags
							</span>

							<div class="flex-w size-217">
								@foreach ($post->tags as $tag)
									<a href="{{ route('blog.tag', ['id' => $tag->id])}}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
										{{ $tag->name }}
									</a>
								@endforeach
							</div>
						</div>

						<!--  -->
						<div class="p-t-40">
							<h5 class="mtext-113 cl2 p-b-12">
								Leave a Comment
							</h5>

							<div id="comment_post">
								@foreach ($comments as $comment)
									<div class="flex-w flex-t p-b-68">
										<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
											<img src="{{ asset($comment->user->image) }}" alt="AVATAR">
										</div>
										<div class="size-207">
											<div class="flex-w flex-sb-m p-b-17">
												<span class="mtext-107 cl2 p-r-20">
													{{ $comment->user->name }}
												</span>
												<small>{{ $comment->created_at->diffForHumans() }}</small>
											</div>

											<p class="stext-102 cl6">
												{{ $comment->content }}
											</p>
										</div>
									</div>
								@endforeach
							</div>

							{{ $comments->links('vendor.pagination.paginate') }}
							
							<div class="p-t-40">
								<form method="POST" action="{{ route('blog.store', ['id' => $post->id]) }}">
									@csrf
									<div class="bor19 m-b-20">
										<textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="comment" placeholder="Comment..."></textarea>
									</div>

									<button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04" type="submit">
										Post Comment
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-lg-3 p-b-80">
					<div class="side-menu">
						<div class="bor17 of-hidden pos-relative">
							<form action="{{ route('blog.search') }}" method="post">
								@csrf
								<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search" required>

								<button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04" type="submit">
									<i class="zmdi zmdi-search"></i>
								</button>
							</form>
						</div>

						<div class="p-t-55">
							<h4 class="mtext-112 cl2 p-b-33">
								Chuyên mục
							</h4>

							<ul>
								@foreach ($postCategories as $postCategory)
									<li class="bor18">
										<a href="{{ route('blog.category', ['slug' => $postCategory->slug]) }}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
											{{ $postCategory->name }}
										</a>
									</li>
								@endforeach
							</ul>
						</div>

						<div class="p-t-50">
							<h4 class="mtext-112 cl2 p-b-27">
								Tags
							</h4>

							<div class="flex-w m-r--5">
								@foreach ($tags as $tag)
									<a href="{{ route('blog.tag', ['id' => $tag->id]) }}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
										{{ $tag->name }}
									</a>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	

@endsection