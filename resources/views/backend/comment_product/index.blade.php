@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Product comments</div>
    
        <div class="card-body">
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Content</th>
                        <th>Destroy</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($commentproducts->count() > 0)
                        @foreach ($commentproducts as $comment)
                            <tr>
                                <th>{{ $comment->id }}</th>
                                <th>{{ $comment->User->name }}</th>
                                <th>{{ $comment->Product->name }}</th>
                                <th>{{ $comment->content }}</th>
                                <th>
                                    <form action="{{ route('commentproducts.destroy', [ 'id' => $comment->id ]) }}" method="POST">
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