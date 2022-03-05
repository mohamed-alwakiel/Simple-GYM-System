@extends('layouts.master')

@section('title')
    Gym Managers
@endsection

@section('content')

    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
        <div>
            <a href="{{ route('gymManagers.banned') }}" class="btn btn-dark my-3 mr-3">Show Banned Managers</a>
            <a href="{{ route('gymManagers.create') }}" class="btn btn-success my-3">Add New Manager</a>
        </div>
    </div>

    <table class="w-75 mx-auto text-center table-bordered border-2 table-striped ">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>National ID</th>
                <th>profile Img</th>

                <th>Gym Name</th>

                <th>Controllers</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($gymManagers as $manager)
                <tr>
                    <th>{{ $manager->name }}</th>
                    <th>{{ $manager->email }}</th>
                    <th>{{ $manager->national_id }}</th>


                    <th>
                        <img src="{{ url('imgs/GymMgr/' . $manager->profile_img) }} " width="50px" height="50px"
                            alt="not found" />
                    </th>

                    <td>{{ $manager->gym ? $manager->gym->name : 'Not Found !' }}</td>


                    <th class="d-flex justify-content-around py-2">

                        @if ($manager->isBanned())
                            <a href="{{ route('gymManagers.unban', $manager->id) }}" class="btn btn-light">UnBan</a>
                        @elseif ($manager->isNotBanned())
                            <a href="{{ route('gymManagers.ban', $manager->id) }}" class="btn btn-dark">Ban</a>
                        @endif

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
