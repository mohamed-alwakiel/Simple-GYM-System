@extends('layouts.master')

@section('title', 'Banned Users')

@section('content')
<div class="container-fluid">
    <div class="px-4">
        @error('msg')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Gyms</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table text-center table-hover">
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

                    @foreach ($bannedManagers as $manager)
                    <tr>
                        <td>{{ $manager->name }}</td>
                        <td>{{ $manager->email }}</td>
                        <td>{{ $manager->national_id }}</td>
                        <td><img src="{{ url('imgs/GymMgr/' . $manager->profile_img) }} " width="50px" height="50px" alt="not found" /></td>
                        <td>{{ $manager->city ? $manager->city->name : 'Not Found !' }}</td>
                        <td>{{ $manager->gym ? $manager->gym->name : 'Not Found !' }}</td>
                        <td>{{ $manager->banned_at }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('gymManagers.unban', $manager->id) }}" class="btn btn-md btn-light" title="UnBan"><i class="fas fa-user-slash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@stop