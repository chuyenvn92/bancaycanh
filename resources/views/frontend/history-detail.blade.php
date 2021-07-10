@extends('layouts.master')

@section('title')
	History shopping detail
@endsection

@section('content')
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
                                <thead>
                                    <tr class="table_head">
                                        <th class="column-1">ID</th>
                                        <th class="column-2">Product name</th>
                                        <th class="column-3"></th>
                                        <th class="column-3">Size</th>
                                        <th class="column-3">Color</th>
                                        <th class="column-3">Qty</th>
                                        <th class="column-3">Price</th>
                                        <th class="column-3">Discout</th>
                                        <th class="column-3">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($order->order_details as $order_detail)
                                        <tr class="table_row">
                                            <td class="column-1">{{ $order_detail->attribute->product->id }}</td>
                                            <td class="column-2">
                                                <img src="{{ asset('uploads/products/'.json_decode($order_detail->attribute->product->image, True)[0]['name']) }}" alt="" style="with:200px; height:160px;">
                                            </td>
                                            <td class="column-3">{{ $order_detail->attribute->product->name }}</td>
                                            <td class="column-3">{{ $order_detail->attribute->size->name }}</td>
                                            <td class="column-3">{{ $order_detail->attribute->color->name }}</td>
                                            <td class="column-3">{{ $order_detail->qty }}</td>
                                            <td class="column-3">{{ number_format($order_detail->attribute->product->price) }} {{ 'VNĐ' }}</td>
                                            <td class="column-3">{{ $order_detail->attribute->product->discount }} %</td>
                                            <td class="column-3">{{ number_format($order_detail->attribute->product->price - $order_detail->attribute->product->price * $order_detail->qty * $order_detail->attribute->product->discount / 100)}} {{ 'VNĐ' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr class="table_row">
                                        <td class="column-3 text-center" colspan="9">Total price:&nbsp;&nbsp;{{ number_format($order->total_price) }} {{ 'VNĐ' }}</td>
                                    </tr>
                                </tfoot>
                            </table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection			