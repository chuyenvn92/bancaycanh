@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Danh sách sảnp phẩm</div>
    
        <div class="card-body">
            <a style="margin-bottom:20px;" class="btn btn-primary" href="{{ route('products.create') }}"><span class="fa fa-plus"></span>&nbsp;&nbsp;Thêm sản phẩm</a>
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giảm giá</th>
                        <th>Size - Color - Số lượng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @if($products->count() > 0)
                        @foreach ($products as $product)
                            <tr>
                                <th>{{ $product->id }}</th>
                                <th>
                                    <img src="{{ asset('uploads/products/'.json_decode($product->image, True)[0]['name']) }}" style="with:300px; height: 200px;" alt="">
                                    <p>{{ $product->name }}</p>
                                </th>
                                <th>{!! $product->description !!}</th>
                                <th>{{ $product->discount }} %</th>
                                <th>
                                    <table class="table">
                                        <tbody>
                                            @foreach ($product->attributes as $attribute)
                                                <tr>
                                                    <th>{{ $attribute->size->name }}</th>
                                                    <th>{{ $attribute->color->name }}</th>
                                                    <th>{{ $attribute->qty }}</th>
                                                </tr>
                                            @endforeach
                                        
                                        </tbody>
                                    </table>
                                </th>
                                
                                {{-- <td>
                                    <a href="{{ route('products.edit', ['id' => $product->id]) }}">Edit</a>
                                </td> --}}
                                <td>
                                    <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Xoá</button>
                                    </form>
                                </td>
                            </tr> 
                        @endforeach
                    @else 
=======
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Danh sách sản phẩm</div>

            <div class="card-body">
                <a style="margin-bottom:20px;" class="btn btn-primary" href="{{ route('products.create') }}"><span
                        class="fa fa-plus"></span>&nbsp;&nbsp;Thêm sản phẩm</a>
                <table id="myTable" class="table table-border table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Giảm giá</th>
                            <th>Số lượng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <th>{{ $product->id }}</th>
                                    <th>
                                        <img src="{{ asset('uploads/products/' . json_decode($product->image, true)[0]['name']) }}"
                                            style="with:300px; height: 200px;" alt="">
                                        <p>{{ $product->name }}</p>
                                    </th>
                                    <th>{!! $product->description !!}</th>
                                    <th>{{ $product->discount }} %</th>
                                    <th>{{ $product->qty }}</th>
                                    <td class="d-flex">
                                        <a href="{{ route('products.edit', ['id' => $product->id]) }}" type="button"
                                            class="btn btn-outline-secondary">Sửa</a>

                                        <form action="{{ route('products.destroy', ['id' => $product->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Xoá</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
>>>>>>> 01d1ea26e24563b26068354449af829fb2eb3a9e
                            <tr>
                                <th class="text-center" colspan="10">Không có dữ liệu</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css" />
@endsection

@section('script')
<<<<<<< HEAD
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
=======
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "sFirst": "Trang đầu",
                        "sLast": "Trang cuối",
                        "sNext": "Trang sau",
                        "sPrevious": "Trang trước",
                    },
                    "info": "Hiển thị từ _START_ tới _END_ của _TOTAL_ bản ghi",
                    "lengthMenu": "Hiện _MENU_ bản ghi",
                },
                "bInfo": false, //hiển thị số bản ghi
            });
        });

    </script>
>>>>>>> 01d1ea26e24563b26068354449af829fb2eb3a9e
@endsection
