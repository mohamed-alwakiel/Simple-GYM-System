@extends('layouts.master')

@section('title', 'Gym Managers')

@section('content')
    <div class="container-fluid">
        <div class="px-4">
            @error('msg')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center mb-3">
                <a href="{{ route('gymManagers.banned') }}" class="btn btn-dark my-3 mr-3">Show Banned Managers</a>
                <a href="{{ route('gymManagers.create') }}" class="btn btn-success my-3">Add New Manager</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Clients</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>National ID</th>
                                <th>profile Img</th>
                                <th>Gym Name</th>
                                @role('admin')
                                    <th>City name</th>
                                @endrole
                                <th>Controllers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gymManagers as $manager)
                                <tr>
                                    <td>{{ $manager->name }}</td>
                                    <td>{{ $manager->email }}</td>
                                    <td>{{ $manager->national_id }}</td>
                                    <td><img src="{{ url('imgs/users/' . $manager->profile_img) }}" width="50px"
                                            height="50px" alt="not found" /></td>
                                    <td>{{ $manager->gym ? $manager->gym->name : 'Not Found !' }}</td>
                                    @role('admin')
                                        <td>{{ $manager->gym ? $manager->gym->city->name : 'Not Found !' }}</td>
                                    @endrole
                                    <td class="d-flex justify-content-center">
                                        @if ($manager->isBanned())
                                            <a href="{{ route('gymManagers.unban', $manager->id) }}"
                                                class="btn btn-md btn-light mr-2" title="UnBan"><i
                                                    class="fas fa-user-slash"></i></a>
                                        @elseif ($manager->isNotBanned())
                                            <a href="{{ route('gymManagers.ban', $manager->id) }}"
                                                class="btn btn-md btn-dark px-3 mr-2" title="Ban"><i
                                                    class="fas fa-user"></i></a>
                                        @endif
                                        <a href="{{ route('gymManagers.show', $manager->id) }}"
                                            class="btn btn-md btn-info mr-2" title="show"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('gymManagers.edit', $manager->id) }}"
                                            class="btn btn-md btn-warning mr-2" title="Edit"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('gymManagers.destroy', $manager->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-md btn-danger show-alert-delete-box px-3"
                                                data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                                        </form>
                                    </td>
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
