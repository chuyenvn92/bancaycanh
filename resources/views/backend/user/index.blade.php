@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Users</div>
    
        <div class="card-body">
            <a style="margin-bottom:20px;" class="btn btn-primary" href="{{ route('users.create') }}"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add user</a>
            <table id="myTable" class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date of birth</th>
                        <th>Gender</th>
                        <th>Number phone</th>
                        <th>Address</th>
                        <th>Is_Admin</th>
                        <th>Edit</th>
                        <th>Destroy</th>
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
                                    {{ 'Male' }}
                                @else
                                    {{ 'Female' }}
                                @endif
                            </th>
                            <th>{{ $user->number_phone }}</th>
                            <th>{{ $user->address }}</th>
                            <th>
                                @switch($user->is_admin)
                                    @case(0)
                                        {{ 'Member' }}
                                        @break
                                    @case(1)
                                        {{ 'Admin' }}
                                        @break
                                    @case(2)
                                        {{ 'Employee' }}
                                        @break
                                    @default   
                                @endswitch
                            </th>
                            <th>
                                <a class="btn btn-outline-primary" href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a>
                            </th>
                            <th>
                                <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-outline-danger" type="submit">Destroy</button>
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
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection


