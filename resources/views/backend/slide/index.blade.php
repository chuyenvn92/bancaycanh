@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Slides</div>
    
        <div class="card-body">
            <a style="margin-bottom:20px;" class="btn btn-primary" href="{{ route('slides.create') }}"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add slide</a>
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Edit</th>
                        <th>Destroy</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($slides->count() > 0)
                        @foreach ($slides as $slide)
                            <tr>
                                <td>{{ $slide->id }}</td>
                                <th>
                                    <img src="{{ asset($slide->image) }}" alt="" style="with:100px; height:60px;">
                                </th>
                                <td>{{ $slide->title }}</td>
                                <td>{!! $slide->content !!}</td>
                                <td>
                                    <a class="btn btn-outline-primary" href="{{ route('slides.edit', ['id' => $slide->id]) }}">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('slides.destroy', ['id' => $slide->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit">Destroy</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <th class="text-center" colspan="6">No data</th>
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


