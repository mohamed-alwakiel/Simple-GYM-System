@extends('layouts.master')
@section('title', 'Attendance')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 px-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Purchases</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table text-center table-hover">
                    <thead>
                        <tr>
                            <th>Trainee</th>
                            <th>Email</th>
                            <th>Session Name</th>
                            <th>City</th>
                            <th>Gym</th>
                            <th>Started at</th>
                            <th>Finished at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->users->name}}</td>
                            <td>{{$attendance->users->email}}</td>
                            <td>{{ $attendance->trainingSessions->name}}</td>
                            {{-- TODO: only for admin --}}
                            <td>{{ $attendance->trainingSessions->gyms->city->name}}</td>
                            {{-- TODO: only for gym manager --}}
                            <td>{{$attendance->trainingSessions->gyms->name}}</td>
                            <td>{{ $attendance->trainingSessions->started_at}}</td>
                            <td>{{ $attendance->trainingSessions->finished_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
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

@include('layouts.alertScript')

@stop