@extends('layouts.master')

@section('title')
    Users
@endsection

@section('content')
    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
        <a href="{{ route('users.create') }}" class="btn btn-success my-3">Add New Client</a>
    </div>

    <table class="w-75 mx-auto text-center table-bordered table-striped border-2">

        <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>National ID</th>

                <th>Controllers</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($users as $user)
                <tr>
                    <th>{{ $user->name }}</th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->national_id }}</th>

                    <th class="d-flex justify-content-around py-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Update</a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">
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
