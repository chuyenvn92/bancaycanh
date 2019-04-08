@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Orders</div>
    
        <div class="card-body">
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Total price</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Detail</th>
                        <th>Destroy</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orders->count() > 0)
                        @foreach ($orders as $order)
                            <tr>
                                <th>{{ $order->id }}</th>
                                <th>{{ $order->user->name }}</th>
                                <th>{{ number_format($order->total_price) }} {{ 'VNĐ' }}</th>
                                <th>
                                    @if ($order->status == 1)
                                        <button class="btn btn-xs btn-success" disabled>{{ $order->status }}&nbsp;<span class="fa fa-check"></span></button>
                                    @else
                                        <button class="btn btn-xs btn-primary" disabled>{{ $order->status }}&nbsp;<span class="fa fa-spinner"></span></button>
                                    @endif
                                </th>
                                <th>{{ date_format(new DateTime($order->created_at), 'H:i:s d-m-Y') }}</th>
                                <th>
                                    <a class="btn btn-outline-primary" href="{{ route('orders.show', ['id' => $order->id]) }}">Detail</a>
                                </th>
                                <th>
                                    <form action="{{ route('orders.destroy', ['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit">Destroy</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <th class="text-center" colspan="7">No data</th>
                            </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
@endsection
    
@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection


