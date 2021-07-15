@extends('layouts.master')

@section('title')
	Lịch sử đặt hàng
@endsection

@section('content')
	{{-- <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('frontend/images/bg-01.jpg	') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			History shopping
		</h2>
	</section> --}}

	<div class="bg0 p-t-75 p-b-85">
		@csrf
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								@if ($orders->count() > 0)
									<tr class="table_head">
										<th class="column-1">STT</th>
										<th class="column-2">Tên</th>
										<th class="column-3">Thành tiền</th>
										<th class="column-3">Trạng thái</th>
										<th class="column-3">Ngày tạo</th>
										<th class="column-5">Chi tiết</th>
									</tr>
									@foreach ($orders as $order)
										<tr class="table_row">
											<td class="column-1">{{ $order->id }}</td>
											<td class="column-2">{{ $order->user->name }}</td>
											<td class="column-3">{{ number_format($order->total_price) }} {{ 'VNĐ' }}</td>
											<td class="column-3">
												@if ($order->status == 0)
													<button class="btn btn-xs btn-danger" disabled><span class="fa fa-remove"></span>&nbsp;{{ 'Chưa xác nhận' }}</button>  
												@elseif($order->status == 1)
													<button class="btn btn-xs btn-primary" disabled><span class="fa fa-spinner"></span>&nbsp;{{ 'Chờ duyệt' }}</button>
												@else
													<button class="btn btn-xs btn-success" disabled>&nbsp;<span class="fa fa-check"></span>&nbsp;{{ 'Đã nhận đơn' }}</button>
												@endif
                                            </td>
											
											<td class="column-3">{{ date_format(new DateTime($order->created_at), 'H:i:s d-m-Y') }}</td>
											<td class="column-5"><a class="stext-101 cl2 hov-cl1 trans-04 m-tb-10" href="{{ route('history.detail', ['id' => $order->id]) }}">Chi tiết</a></td>
										</tr>
                                    @endforeach
								@else
										<tr class="table_row">
											<th	colspan="6" class="text-center">Không có đơn hàng nào</th>
										</tr>
                                @endif
                                
                            </table>
                            <div class="flex-c-m flex-w w-full p-t-45">
                                {{ $orders->links('vendor/pagination/paginate') }}
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection			