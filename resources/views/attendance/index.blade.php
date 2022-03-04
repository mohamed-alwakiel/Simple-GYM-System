
@extends('layouts.master')

@section('title')
Sessions
@endsection

@section('content')
<div class='container dark:bg-gray-900 w-70' id='session_data'>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">trainee</th>
                <th scope="col">Email</th>

                <th scope="col">training session name</th>
                <th scope="col">city name</th>
                <th scope="col">gym name</th>

                <th scope="col">started_at</th>
                <th scope="col">finished_at </th>

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
                    <td>{{ $attendance->trainingSessions->started_at}}</td>
                    {{-- <td>{{ $session->started_at }}</td> --}}

                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
<!-- /.content-wrapper -->
