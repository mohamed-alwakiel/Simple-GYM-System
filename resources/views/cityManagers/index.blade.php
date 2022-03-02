@extends('layouts.master')

@section('title')
    City Managers
@endsection

@section('content')
    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">

        <a href="{{ route('cityManagers.create') }}" class="btn btn-success my-3">Add New Manager</a>
    </div>
    <table class="w-75 mx-auto text-center table-bordered table-striped ">

        <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>National ID</th>

                <th>Controllers</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($cityManagers as $manager)
                <tr>
                    <th>{{ $manager->name }}</th>
                    <th>{{ $manager->email }}</th>
                    <th>{{ $manager->national_id }}</th>

                    <th class="d-flex justify-content-around py-2">
                        <a href="{{ route('cityManagers.edit', $manager->id) }}" class="btn btn-primary">Update</a>

                        <form action="{{ route('cityManagers.destroy', $manager->id) }}" method="post">
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
@endsection
