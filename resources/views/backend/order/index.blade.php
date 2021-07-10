@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Đơn đặt hàng</div>
    
        <div class="card-body">
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Người mua</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>Chi tiết</th>
                        <th>Xóa</th>
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
                                    @if ($order->status == 0)
                                        <button class="btn btn-xs btn-danger" disabled><span class="fa fa-remove"></span>&nbsp;{{ 'Chưa xác nhận' }}</button>  
                                    @elseif($order->status == 1)
                                        <button class="btn btn-xs btn-primary" disabled><span class="fa fa-spinner"></span>&nbsp;{{ 'Chờ xử lý' }}</button>
                                    @else
                                        <button class="btn btn-xs btn-success" disabled><span class="fa fa-check"></span>&nbsp;{{ 'Đã xử lý' }}</button>
                                    @endif
                                </th>
                                <th>{{ date_format(new DateTime($order->created_at), 'H:i:s d-m-Y') }}</th>
                                <th>
                                    <a class="btn btn-outline-primary" href="{{ route('orders.show', ['id' => $order->id]) }}">Chi tiết</a>
                                </th>
                                <th>
                                    <form action="{{ route('orders.destroy', ['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit">Xóa</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <th class="text-center" colspan="7">Không có dữ liệu</th>
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
        $(document).ready(function(){
            $('#myTable').DataTable({
            "language": {
                "search": "Tìm kiếm:",
                "paginate": {
                "sFirst": "Trang đầu",
                "sLast": "Trang cuối",
                "sNext": "Trang sau" ,
                "sPrevious": "Trang trước",          
                },
                "info": "Hiển thị từ _START_ tới _END_ của _TOTAL_ bản ghi",
                "lengthMenu":     "Hiện _MENU_ bản ghi",   
                "zeroRecords": "Không tìm thấy dữ liệu"      
            },
            "bInfo" : false,//hiển thị số bản ghi
            });
        });	
    </script>
@endsection


