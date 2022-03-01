@extends('layouts.master')

<!-- @section('title')
    Gym Managers
@endsection -->

@section('content')
    <!-- Content Wrapper. Contains page content -->
    {{-- <div class="content-wrapper text-center"> --}}

        <a href="{{ route('gymManagers.create') }}" class="btn btn-dark">Create</a>

        <a href="{{ route('gymManagers.create') }}" class="btn btn-success my-3">Add New Manager</a>

        <table class="w-75 mx-auto text-center table-bordered table-striped ">

            <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>role</th>

                    <th>Controllers</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($gymManagers as $manager)
                    <tr>
                        <th>{{ $manager->name }}</th>
                        <th>{{ $manager->email }}</th>
                        <th>{{ $manager->role_type }}</th>

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


    {{-- </div> --}}
    <!-- /.content-wrapper -->
@endsection
