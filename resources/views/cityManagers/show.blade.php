@extends('layouts.master')
@section('title', "View City Manager Information")

@section('content')
<div class="container p-5">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">City Manager Info : <b>{{ $manager->name }}</b></h3>

            <div class="card-tools row">
                <div class="col-md-4">
                    <a class="btn btn-tool btn-info" href="{{ route('cityManagers.edit', $manager->id) }}"><i class="fas fa-pencil-alt"></i></a>
                </div>
                <form class="col-md-4" action="{{ route('cityManagers.destroy', $manager->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text text-secondary">Name : <span class="text-light font-weight-bold">{{$manager->name}}</span> </p>
            <p class="card-text text-secondary">Email : <span class="text-light font-weight-bold">{{$manager->email}}</span> </p>
            <p class="card-text text-secondary">DOB : <span class="text-light font-weight-bold">{{$manager->date_of_birth}}</span> </p>
            <p class="card-text text-secondary">Gender : <span class="text-light font-weight-bold">{{$manager->gender}}</span> </p>
            <p class="card-text text-secondary">National ID : <span class="text-light font-weight-bold">{{$manager->national_id}}</span> </p>
            <p class="card-text text-secondary">City : <span class="text-light font-weight-bold">{{$manager->city->name}}</span> </p>
        </div>
    </div>
</div>
@stop

@section('script')
@include('layouts.alertScript')
@stop