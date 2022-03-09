@extends('layouts.master')

@section('title')
    Banned Users
@endsection

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Banned Managers</h3>
                </div>
                <div class="card-body">
                    <table id="table_id" class="table text-center ">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>National ID</th>
                <th>profile Img</th>

                <th>City Name</th>
                <th>Gym Name</th>

                <th>Banned At</th>

                <th>UnBan</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($bannedManagers as $manager)
                <tr class="bg-dark">
                    <th>{{ $manager->name }}</th>
                    <th>{{ $manager->email }}</th>
                    <th>{{ $manager->national_id }}</th>

                    <th>
                        <img src="{{ url('imgs/GymMgr/' . $manager->profile_img) }} " width="50px" height="50px"
                            alt="not found" />
                    </th>

                    <td>{{ $manager->city ? $manager->city->name : 'Not Found !' }}</td>
                    <td>{{ $manager->gym ? $manager->gym->name : 'Not Found !' }}</td>

                    <td>{{ $manager->banned_at }}</td>

                    <th class="d-flex justify-content-around py-2">
                        <a href="{{ route('gymManagers.unban', $manager->id) }}" class="btn btn-light">UnBan</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
