@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Danh sách tag</div>
    
        <div class="card-body">
            <a style="margin-bottom:20px;" class="btn btn-primary" href="{{ route('tags.create') }}"><span class="fa fa-plus"></span>&nbsp;&nbsp;Thêm tag</a>

            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @if($tags->count() > 0)
                        @foreach ($tags as $tag)
                            <tr>
                                <th>{{ $tag->id }}</th>
                                <th>{{ $tag->name }}</th>
                                <th>
                                    <a class="btn btn-xs btn-outline-primary" href="{{ route('tags.edit', ['id' => $tag->id]) }}">Sửa</a>
                                </th>
                                <th>
                                    <form action="{{ route('tags.destroy', [ 'id' => $tag->id ]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-xs btn-outline-danger" type="submit">Xóa</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    @else 
                            <tr>
                                <th class="text-center" colspan="4">Không có dữ liệu</th>
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
        },
        "bInfo" : false,//hiển thị số bản ghi
        });
    });	
</script>
@endsection