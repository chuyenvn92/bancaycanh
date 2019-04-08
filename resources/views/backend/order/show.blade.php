@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Order details</div>
    
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name custommer') }}</label>

                <div class="col-md-10">
                    <label class="form-control">{{ $order->user->name }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                <div class="col-md-10">
                    <label class="form-control">{{ date_format(new DateTime($order->user->dob), 'd-m-Y') }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Sex') }}</label>

                <div class="col-md-10">
                    <label class="form-control">@if ($order->user->sex == 1)
                        {{ 'Male' }}
                    @else
                        {{ 'Female' }}
                    @endif</label>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-10">
                    <textarea rows="4" readonly class="form-control">{{ $order->user->address }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Number phone') }}</label>

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
                <label class="col-md-2 col-form-label text-md-right">{{ __('Order') }}</label>
                <div class="col-md-10">
                    <table id="myTable" class="table table-border table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product name</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Discout</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->order_details as $order_detail)
                                <tr>
                                    <th>{{ $order_detail->attribute->product->id }}</th>
                                    <th>
                                        <img src="{{ asset($order_detail->image) }}" alt="" style="with:100px; height:80px;">
                                        {{ $order_detail->attribute->product->name }}
                                    </th>
                                    <th>{{ $order_detail->attribute->size->name }}</th>
                                    <th>{{ $order_detail->attribute->color->name }}</th>
                                    <th>{{ $order_detail->qty }}</th>
                                    <th>{{ number_format($order_detail->attribute->product->price) }} {{ 'VNĐ' }}</th>
                                    <th>{{ $order_detail->attribute->product->discount }} %</th>
                                    <th>{{ number_format($order_detail->attribute->product->price * $order_detail->qty * $order_detail->attribute->product->discount / 100)}} {{ 'VNĐ' }}</th>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="row">Totals</th>
                                <th colspan="5">{{ number_format($order->total_price) }} {{ 'VNĐ' }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-10 offset-md-2">

                    @if ($order->status == 1)
                        <button class="btn btn-xs btn-success" disabled="disabled"><span class="fa fa-check"></span>&nbsp; {{ __('Success') }}</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-xs btn-primary" ><span class="fa fa-arrow-left"></span>&nbsp; {{ __('Back') }}</a>                            
                    @else
                        <form action="{{ route('orders.update', ['id' => $order->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-xs btn-primary" type="submit"><span class="fa fa-spinner"></span>&nbsp; {{ __('Change Status') }}</button>        
                            <a href="{{ route('orders.index') }}" class="btn btn-xs btn-primary" ><span class="fa fa-arrow-left"></span>&nbsp; {{ __('Back') }}</a>                                             
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

