@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Thống kê đơn hàng đã xử lý</div>
    
        <div class="card-body">       
        <form action="{{ route('report.date') }}" method="GET">
        <div class="row mt-2 mb-4">
                                <div class="col-md-2">
                                    <p>Lượt đặt từ:</p>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="date_from">
                                </div>
                                <div class="col-md-2">
                                    <p>Đến</p>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="date_to">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary">Tìm</button>
                                </div>
                            </div>
            </form>
            <h5>Tổng doanh thu: {{ number_format($total) }} {{ 'VNĐ'}}</h5>
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Người mua</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
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


