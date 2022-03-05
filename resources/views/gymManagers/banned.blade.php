@extends('layouts.master')

@section('title')
    Banned Users
@endsection

@section('content')
    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
    </div>

    <table class="w-75 mx-auto text-center table-bordered border-2 table-striped ">

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
                <tr>
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
@endsection
