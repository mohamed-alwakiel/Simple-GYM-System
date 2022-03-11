@extends('layouts.master')

@section('title', 'City Managers')

@section('content')
    <div class="container-fluid">
        <div class="px-4">
            @error('msg')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center mb-3">
                <a href="{{ route('cityManagers.create') }}" class="btn btn-success my-3">Add New Manager</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Clients</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>email</th>
                                <th>National ID</th>
                                <th>profile Img</th>
                                <th>City</th>
                                <th>Controllers</th>
                            </tr>
                        </thead>

                        @foreach ($cityManagers as $manager)
                            <tr>
                                <td>{{ $manager->name }}</td>
                                <td>{{ $manager->email }}</td>
                                <td>{{ $manager->national_id }}</td>
                                <td><img src="{{ url('imgs/users/' . $manager->profile_img) }} " width="50px"
                                        height="50px" alt="not found" /></td>
                                <td>{{ $manager->city ? $manager->city->name : 'Not Found !' }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('cityManagers.show', $manager->id) }}"
                                        class="btn btn-md btn-info mr-2" title="show"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('cityManagers.edit', $manager->id) }}"
                                        class="btn btn-md btn-warning mr-2" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('cityManagers.destroy', $manager->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-md btn-danger show-alert-delete-box px-3"
                                            data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                                    </form>
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

    @include('layouts.alertScript')
@stop
