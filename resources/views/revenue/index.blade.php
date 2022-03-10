@extends('layouts.master')

@section('title', 'Revenue')

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
                            <th class="text-center">Client Name</th>
                            <th class="text-center">Client email</th>
                            <th class="text-center">Package Name</th>
                            <th class="text-center">Paid Price</th>
                            @role('admin|cityManager')
                            <th class="text-center">Gym</th>
                            @endrole
                            @role('admin')
                            <th class="text-center">City</th>
                            <th>Controllers</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boughtPackages as $boughtPackage)
                        <tr>
                            <th>{{ $boughtPackage->user->name }}</th>
                            <th>{{ $boughtPackage->user->email }}</th>
                            <th>{{ $boughtPackage->name }}</th>
                            <th>{{ $boughtPackage->price }}</th>
                            @role('admin|cityManager')
                            <th>{{ $boughtPackage->gym->name }}</th>
                            @endrole
                            @role('admin')
                            <th>{{ $boughtPackage->city->name }}</th>
                            @endrole
                            <th class="d-flex justify-content-center">
                                <a href="{{ route('revenue.show', $boughtPackage->id) }}" class="btn btn-md btn-info"><i class="fas fa-eye"></i></a>
                                @role('admin')
                                <form class="col-md-4" action="{{ route('revenue.destroy', $boughtPackage->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-md btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                                </form>
                                @endrole
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
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