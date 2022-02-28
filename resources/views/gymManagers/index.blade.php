@extends('layouts.master')

@section('title')
    Gym Managers
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <a href="{{ route('gymManagers.create') }}" class="btn btn-dark">Create</a>

        <p>All Managers</p>

        <table>

            <tr>
                <th>name</th>
                <th>email</th>
                <th>role</th>
            </tr>

            @foreach ($gymManagers as $manager)
                <tr>
                    <th>{{ $manager->name }}</th>
                    <th>{{ $manager->email }}</th>
                    <th>{{ $manager->role_type }}</th>
                </tr>
            @endforeach

        </table>


    </div>
    <!-- /.content-wrapper -->
@endsection
