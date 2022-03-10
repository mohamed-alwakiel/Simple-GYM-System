@extends('layouts.master')

@section('title', 'Gyms')

@section('content')
<div class="container-fluid">
    <div class="px-4">
        @error('msg')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="d-flex justify-content-center mb-3">
            <a href="{{ route('gyms.create') }}" class="btn btn-success my-3">Add New Gym</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Gyms</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table text-center table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Cover Image</th>
                            @role('admin')
                            <th>City Name</th>
                            <th>City Manager</th>
                            @endrole
                            <th>Controllers</th>
                        </tr>
                    </thead>
                    @foreach ($gyms as $gym)
                    <tr>
                        <th>{{ $gym->name }}</th>
                        <th><img src="{{ url('imgs/gym/' . $gym->cover_img) }} " width="50px" height="50px" alt="not found" /></th>
                        @role('admin')
                        <th>{{ $gym->city ? $gym->city->name : 'Not Found ! '}}</th>
                        <th>{{ $gym->city->manager ? $gym->city->manager->name : 'Not Found !' }}</th>
                        @endrole
                        <th class="d-flex justify-content-center">
                            <a href="{{ route('gyms.show', $gym->id) }}" class="btn btn-md btn-info mr-3"><i class="fas fa-eye"></i></a>
                            @role('admin')
                            <a href="{{ route('gyms.edit', $gym->id) }}" class="btn btn-md btn-warning mr-3"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('gyms.destroy', $gym->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-md btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                            </form>
                            @endrole
                        </th>
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