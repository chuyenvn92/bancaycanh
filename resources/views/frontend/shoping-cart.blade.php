@extends('layouts.master')

@section('title')
	Giỏ hàng
@endsection

@section('content')
	{{-- <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('frontend/images/bg-01.jpg	') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Shopping cart
		</h2>
	</section> --}}

	<form class="bg0 p-t-75 p-b-85" action="{{ route('order.update') }}" method="POST">
		@csrf
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								@if (Cart::count())
									<tr class="table_head">
										<th class="column-1">Sản phẩm</th>
										<th class="column-2"></th>
										<th class="column-3">Giảm giá</th>
										<th class="column-3">Giá</th>
										<th class="column-4">Số lượng</th>
										<th class="column-5">Tổng tiền</th>
									</tr>
									@foreach ($carts as $cart)
										<tr class="table_row">
											<td class="column-1">
												<a href="{{ route('order.destroy', ['id' => $cart->rowId]) }}">
													<div class="how-itemcart1">
														<img src="{{ asset('uploads/products/'. $cart->options->image) }}" alt="">
													</div>
												</a>
											</td>
											<td class="column-2">
												<p>{{ $cart->name }}</p>
												<p>{{ $cart->options->size }} {{ $cart->options->color }}</p>	
											</td>
											<td class="column-3">{{ $cart->options->discount }} {{ '%' }}</td>
											<td class="column-3">{{ number_format($cart->options->price) }}</td>
											
											<td class="column-4">
												<div class="wrap-num-product flex-w m-l-auto m-r-0">
													<input type="text" name="rowid[]" value="{{ $cart->rowId }}" hidden>
													<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
														<i class="fs-16 zmdi zmdi-minus"></i>
													</div>
													
													<input class="mtext-104 cl3 txt-center num-product" min="1" type="number" name="qty[]" value="{{ $cart->qty }}">

													<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
														<i class="fs-16 zmdi zmdi-plus"></i>
													</div>
												</div>
			
											</td>
											<td class="column-5">{{ number_format($cart->price * $cart->qty) }}</td>
										</tr>
									@endforeach
								@else
										<tr class="table_row">
											<th	colspan="6" class="text-center">Không có sản phẩm nào</th>
										</tr>
								@endif
							</table>
						</div>

						@if (Cart::count())
							<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
								<div class="flex-w flex-m m-r-20 m-tb-5">		
									<button type="submit" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
										Cập nhật giỏ hàng
									</button>
								</div>
							</div>
						@endif
					</div>
				</div>
	
				@if (Cart::count())
					<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
						<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
							<h4 class="mtext-109 cl2 p-b-30">
								THÀNH TIỀN
							</h4>
		
							<div class="flex-w flex-t p-t-27 p-b-33">
								<div class="size-208">
									<span class="mtext-101 cl2">
										TỔNG
									</span>
								</div>

								<div class="size-209 p-t-1">
									<span class="mtext-110 cl2">
										{{ Cart::total() }} {{ 'VNĐ' }}
									</span>
								</div>
							</div>
							<form action="" method="post"></form>
							<form action="{{ route('order.checkout') }}" method="post">
								@csrf						
								<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
									Đặt hàng
								</button>
							</form>
						</div>
					</div>
				@endif
			</div>
		</div>
	</form>
	
@endsection			