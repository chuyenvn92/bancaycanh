@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Products</div>
    
        <div class="card-body">
            <a style="margin-bottom:20px;" class="btn btn-primary" href="{{ route('products.create') }}"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add product</a>
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Discout</th>
                        <th>Size - Color - Qty</th>
                        <th>Destroy</th>
                    </tr>
                </thead>
                <tbody>
                    @if($products->count() > 0)
                        @foreach ($products as $product)
                            <tr>
                                <th>{{ $product->id }}</th>
                                <th>
                                    <img src="{{ asset($product->image) }}" style="with:100px; height: 60px;" alt="">
                                    {{ $product->name }}
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
                                        <button type="submit" class="btn btn-outline-danger">Destroy</button>
                                    </form>
                                </td>
                            </tr> 
                        @endforeach
                    @else 
                            <tr>
                                <th class="text-center" colspan="10">No data</th>
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
