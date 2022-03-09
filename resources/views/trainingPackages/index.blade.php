@extends('layouts.master')

@section('title', 'Training Packages')

@section('content')

<div class="container-fluid">
    @role('admin')
    <div class="d-flex justify-content-center mb-3">
        <a href="{{ route('trainingPackages.create') }}" class="btn btn-success">Add New Package</a>
    </div>
    @endrole
    <div class="col-md-12 px-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Packages</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table text-center table-hover">
                    <thead>
                        <tr>
                            <th class="col-2">name</th>
                            <th class="col-2">price</th>
                            <th class="col-2">Number Of Sessions</th>
                            <th class="col-2">Created At</th>
                            <th class="col-2">Actions</th>
                        </tr>
                    </thead>
                    @foreach ($packageCollection as $package)
                    <tr>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->price }}</td>
                        <td>{{ $package->number_of_sessions }}</td>
                        <td>{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </td>
                        <td class="d-flex justify-content-center">
                            <!-- Show Button -->
                            <a href="{{ route('trainingPackages.show', ['package' => $package->id]) }}" class="btn btn-md btn-info mr-3"><i class="fas fa-eye"></i></a>
                            <!-- Edit & Delete Buttons -->
                            @role('admin')
                            <a href="{{ route('trainingPackages.edit', ['package' => $package->id]) }}" class="btn btn-md btn-warning"><i class="fas fa-edit"></i></a>
                            <form class="col-md-4" action="{{ route('trainingPackages.destroy',$package->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-md btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                            </form>
                            @endrole
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@include('layouts.alertScript')
@stop

@stop