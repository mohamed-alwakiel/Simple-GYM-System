@extends('layouts.master')

@section('title')
Users
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<a href="{{ route('users.create') }}" class="btn btn-success my-3">Add New User</a>

<table class="w-75 mx-auto text-center table-bordered table-striped ">

    <thead>
        <tr>
            <th>name</th>
            <th>email</th>
            <th>image</th>
            <th>role</th>

            <th>Controllers</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($users as $user)
            <tr>
                <th>{{ $user->name }}</th>
                <th>{{ $user->email }}</th>
                <th>{{ $user->profile_img }}</th>
                <th>{{ $user->role_type }}</th>

                <th class="d-flex justify-content-around py-2">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Update</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are You Sure You Want To Delete?');">
                            Delete
                        </button>
                    </form>

                </th>
            </tr>
        @endforeach
    </tbody>
</table>











</div>
<!-- /.content-wrapper -->
@endsection
