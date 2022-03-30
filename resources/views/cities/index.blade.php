@extends('layouts.master')

@section('title', 'Cities')

@section('content')
    <div class="container-fluid">
        <div class="px-4">
            @error('msg')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center mb-3">
                <a href="{{ route('cities.create') }}" class="btn btn-success">Add New City</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Cities</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Manager</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @foreach ($cities as $city)
                            <tr>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->manager->hasRole('cityManager') ? $city->manager->name : 'No Manager !' }}</td>

                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('cities.show', $city->id) }}" class="btn btn-md btn-info mr-3"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-md btn-warning mr-3"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('cities.destroy', $city->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md btn-danger show-alert-delete-box"
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
