@extends('layouts.master')

@section('title')
	Shop
@endsection

@section('content')
	
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						Tất cả sản phẩm
					</button>

					@foreach ($productCategories as $productCategory)
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $productCategory->slug }}">
							{{ $productCategory->name }}
						</button>
					@endforeach
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>

			</div>

			<div class="row isotope-grid">
				@foreach ($products as $product)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product->product_category->slug }}">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('uploads/products/'.json_decode($product->image, True)[0]['name']) }}" alt="IMG-PRODUCT">
								{{-- // . json_decode($product->image, True)[0]['name'] --}}
								<a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
									Xem chi tiết
								</a>
							</div>
							{{-- js-show-modal1 --}}
							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l">
									<a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										{{ $product->name }}
									</a>
									<strike>
										<span class="stext-105 cl3">
											{{ number_format($product->price) }} {{ 'VNĐ' }}
										</span>
									</strike>
									<span class="stext-105 cl1">
										{{ number_format($product->price - $product->price * $product->discount/100) }} {{ 'VNĐ' }}
									</span>
								</div>
								<div class="block2-txt-child2 flex-r p-t-3">
									<span class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										{{ '-' }}{{ $product->discount }}{{ '%' }}
									</span>
								</div>
							</div>
						</div>
					</div>
				@endforeach					
			</div>
	
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				{{ $products->links('vendor/pagination/paginate') }}
			</div>
		</div>
	</div>

@endsection
