@extends('layouts.master')

@section('title')
	Product detail
@endsection

@section('content')
	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								@foreach (json_decode($product->image, TRUE) as $image)
									<div class="item-slick3" data-thumb="{{ asset('uploads/products/' . $image['name']) }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('uploads/products/' . $image['name']) }}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('uploads/products/' . $image['name']) }}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							{{ $product->name }}
						</h4>

						<span class="mtext-106 cl2">
							{{ number_format($product->price) }} {{ 'VNĐ' }}
						</span>

						<p class="stext-102 cl3 p-t-23">
							{!! $product->description !!}
						</p>
						
						<!--  -->
						<form action="{{ route('order.store') }}" method="post">
							@csrf
							<input type="text" value="{{ $product->id }}" name="product_id" hidden>
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>
	
									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="size">
												@foreach ($sizes as $size)
													<option value="{{ $size->id }}">{{ $size->name }}</option>
												@endforeach
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>
	
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>
	
									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="color">
												@foreach ($colors as $color)
													<option value="{{ $color->id }}">{{ $color->name }}</option>
												@endforeach
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>
	
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>
	
											<input class="mtext-104 cl3 txt-center num-product" type="number" name="qty" value="1" required>
	
											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
	
										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
											Add to cart
										</button>
									</div>
								</div>	
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews ({{ $comments_count }})</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									{!! $product->description !!}
								</p>
							</div>
						</div>

						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<div id="paginate">
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
	
											{{ $comments->links('vendor.pagination.paginate') }}
										</div>
										

										<!-- Add review -->
										<div class="p-t-40">
											<form class="w-full" method="POST" action="{{ route('product.store', ['id' => $product->id]) }}">
												@csrf
												<h5 class="mtext-108 cl2 p-b-7">
													Add a review
												</h5>

												<div class="row p-b-25">
													<div class="col-12 p-b-5">
														<label class="stext-102 cl3" for="review">Your review</label>
														<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
													</div>
												</div>

												<button id="submit" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
													Submit
												</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					@foreach ($relatedProducts as $relatedProduct)
						<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-pic hov-img0">
									<img src="{{ asset('uploads/products/'.json_decode($relatedProduct->image, True)[0]['name']) }}" alt="IMG-PRODUCT">
	
									<a href="{{ route('product.detail', ['slug' => $relatedProduct->slug]) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
										View detail
									</a>
								</div>
	
								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="{{ route('product.detail', ['slug' => $relatedProduct->slug]) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											{{ $relatedProduct->name }}
										</a>
	
										<span class="stext-105 cl3">
											{{ number_format($product->price) }} {{ 'VNĐ' }}
										</span>
									</div>
	
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
@endsection

{{-- @section('script')

	<script type="text/javascript">
		$(document).ready(function () {
			$('#submit').click(function (e) { 
				e.preventDefault();

				$.ajax({
					type: "post",
					url: "{{ route('product.store') }}",
					data: $('form').serialize(),
					success: function (response) {
						$('#reviews').html(response);
					},
				});
			});
		});
	</script>

@endsection --}}