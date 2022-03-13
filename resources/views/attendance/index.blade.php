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
                            <th scope="col">Trainee</th>
                            <th scope="col">Email</th>
                            <th scope="col">Session Name</th>
                            <th scope="col">City Name</th>
                            <th scope="col">Gym Name</th>
                            <th scope="col">Started at</th>
                            <th scope="col">Finished at </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->users->name}}</td>
                            <td>{{ $attendance->users->email}}</td>
                            <td>{{ $attendance->trainingSessions ? $attendance->trainingSessions->name : 'Not Found !'}}</td>

                            <td>{{ $attendance->trainingSessions ? $attendance->trainingSessions->gyms->city->name : 'Not Found !'}}</td>
                            
                            <td>{{ $attendance->trainingSessions ? $attendance->trainingSessions->gyms->name : 'Not Found !'}}</td>
                            <td>{{ $attendance->trainingSessions ? $attendance->trainingSessions->started_at : 'Not Found !'}}</td>
                            <td>{{ $attendance->trainingSessions ? $attendance->trainingSessions->finished_at : 'Not Found !'}}</td>
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
