@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Danh sách bình luận sản phẩm</div>
    
        <div class="card-body">
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Người bình luận</th>
                        <th>Tên sản phẩm</th>
                        <th>Nội dung</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($commentproducts->count() > 0)
                        @foreach ($commentproducts as $comment)
                            <tr>
                                <th>{{ $comment->id }}</th>
                                <th>{{ $comment->user->name }}</th>
                                <th>{{ $comment->product->name }}</th>
                                <th>{{ $comment->content }}</th>
                                <th>
                                    <form action="{{ route('commentproducts.destroy', [ 'id' => $comment->id ]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-xs btn-outline-danger" type="submit">Xóa</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <th class="text-center" colspan="5">Không có dữ liệu</th>
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