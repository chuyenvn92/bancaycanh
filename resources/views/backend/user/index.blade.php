@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Danh sách người dùng</div>
    
        <div class="card-body">
            <a style="margin-bottom:20px;" class="btn btn-primary" href="{{ route('users.create') }}"><span class="fa fa-plus"></span>&nbsp;&nbsp;Thêm người dùng</a>
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Quyền</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <th>{{ $user->name }}</th>
                            <th>{{ $user->dob }}</th>
                            <th>
                                @if ($user->sex == 1)
                                    {{ 'Nam' }}
                                @else
                                    {{ 'Nữ' }}
                                @endif
                            </th>
                            <th>{{ $user->number_phone }}</th>
                            <th>{{ $user->address }}</th>
                            <th>
                                @switch($user->is_admin)
                                    @case(0)
                                        {{ 'Khách hàng' }}
                                        @break
                                    @case(1)
                                        {{ 'Admin' }}
                                        @break
                                    @case(2)
                                        {{ 'Nhân viên' }}
                                        @break
                                    @default   
                                @endswitch
                            </th>
                            <th>
                                <a class="btn btn-outline-primary" href="{{ route('users.edit', ['id' => $user->id]) }}">Sửa</a>
                            </th>
                            <th>
                                <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-outline-danger" type="submit">Xóa</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
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
        },
        "bInfo" : false,//hiển thị số bản ghi
        });
    });	
</script>
@endsection


