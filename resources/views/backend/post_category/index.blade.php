@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Post categories</div>
    
        <div class="card-body">
            <a style="margin-bottom:20px;" class="btn btn-primary" href="{{route('postcategories.create')}}"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add post category</a>
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Edit</th>
                        <th>Destroy</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($postCategories->count() > 0)
                        @foreach ($postCategories as $category)
                            <tr>
                                <th>{{ $category->id }}</th>
                                <th>{{ $category->name }}</th>
                                <th>{{ $category->slug }}</th>
                                <th>
                                    <a class="btn btn-xs btn-outline-primary" href="{{route('postcategories.edit', ['id' => $category->id])}}">Edit</a>
                                </th>
                                <th>
                                    <form action="{{route('postcategories.destroy', ['id' => $category->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-xs btn-outline-danger" type="submit">Destroy</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    @else 
                            <tr>
                                <th class="text-center" colspan="5">No data</th>
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

