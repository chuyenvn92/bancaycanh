@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Chi tiết đơn đặt hàng</div>
    
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Tên khách hàng') }}</label>

                <div class="col-md-10">
                    <label class="form-control">{{ $order->user->name }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Ngày sinh') }}</label>

                <div class="col-md-10">
                    <label class="form-control">{{ date_format(new DateTime($order->user->dob), 'd-m-Y') }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Giới tính') }}</label>

                <div class="col-md-10">
                    <label class="form-control">@if ($order->user->sex == 1)
                        {{ 'Nam' }}
                    @else
                        {{ 'Nữ' }}
                    @endif</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">{{ __('Địa chỉ') }}</label>

                <div class="col-md-10">
                    <textarea rows="4" readonly class="form-control">{{ $order->user->address }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>

                <div class="col-md-10">
                    <label class="form-control">{{ $order->user->number_phone }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('E-mail') }}</label>

                <div class="col-md-10">
                    <label class="form-control">{{ $order->user->email }}</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-12 col-form-label text-md-center">{{ __('Đơn đặt hàng') }}</label>
                <div class="col-md-12">
                    <table id="myTable" class="table table-border table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Chiết khấu</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->order_details as $order_detail)
                                <tr>
                                    <th>{{ $order_detail->id }}</th>
                                    <th>
                                        <img src="{{ asset($order_detail->image) }}" alt="" style="with:100px; height:80px;">
                                        {{ $order_detail->attribute->product->name }}
                                    </th>
                                    <th>{{ $order_detail->qty }}</th>
                                    <th>{{ number_format($order_detail->attribute->product->price) }} {{ 'VNĐ' }}</th>
                                    <th>{{ $order_detail->attribute->product->discount }} %</th>
                                    <th>{{ number_format($order_detail->attribute->product->price - $order_detail->attribute->product->price * $order_detail->qty * $order_detail->attribute->product->discount / 100)}} {{ 'VNĐ' }}</th>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="row">Tổng tiền đơn hàng</th>
                                <th colspan="7">{{ number_format($order->total_price) }} {{ 'VNĐ' }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-10 offset-md-2">

                    @if ($order->status == 1)
                        <form action="{{ route('orders.update', ['id' => $order->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-xs btn-primary" type="submit"><span class="fa fa-spinner"></span>&nbsp; {{ __('Chuyển trạng thái') }}</button>
                            <a href="{{ route('orders.index') }}" class="btn btn-xs btn-primary" ><span class="fa fa-arrow-left"></span>&nbsp; {{ __('Quay lại') }}</a>                                
                        </form>
                    @elseif($order->status == 0)
                        <button class="btn btn-xs btn-danger" disabled="disabled"><span class="fa fa-remove"></span>&nbsp; {{ __('Chưa xác nhận') }}</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-xs btn-primary" ><span class="fa fa-arrow-left"></span>&nbsp; {{ __('Quay lại') }}</a>
                    @else
                        <button class="btn btn-xs btn-success" disabled="disabled"><span class="fa fa-check"></span>&nbsp; {{ __('Đã xử lý') }}</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-xs btn-primary" ><span class="fa fa-arrow-left"></span>&nbsp; {{ __('Quay lại') }}</a>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

