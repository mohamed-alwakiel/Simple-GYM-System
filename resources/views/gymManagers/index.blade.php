@extends('layouts.master')

@section('title')
    Gym Managers
@endsection

@section('content')

    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
        <a href="{{ route('gymManagers.create') }}" class="btn btn-success my-3">Add New Manager</a>
    </div>

    <table class="w-75 mx-auto text-center table-bordered border-2 table-striped ">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>National ID</th>

                <th>Controllers</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($gymManagers as $manager)
                <tr>
                    <th>{{ $manager->name }}</th>
                    <th>{{ $manager->email }}</th>
                    <th>{{ $manager->national_id }}</th>

                    <th class="d-flex justify-content-around py-2">
                        <a href="{{ route('gymManagers.edit', $manager->id) }}" class="btn btn-primary">Update</a>

                        <form action="{{ route('gymManagers.destroy', $manager->id) }}" method="post">
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
