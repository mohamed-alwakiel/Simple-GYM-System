@extends('layouts.master')
@section('title', "View Coach Information")

@section('content')
<div class="container p-5">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Coach Info : <b>{{ $coach->name }}</b></h3>

            <div class="card-tools row">
                <div class="col-md-4">
                    <a class="btn btn-tool btn-info" href="{{ route('coaches.edit', $coach->id) }}"><i class="fas fa-pencil-alt"></i></a>
                </div>
                <form class="col-md-4" action="{{ route('coaches.destroy', $coach->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                </form>
            </div>
        </div>

        <div class="card-body">
            <p class="card-text text-secondary">Name : <span class="text-light font-weight-bold">{{$coach->name}}</span> </p>
            <p class="card-text text-secondary">Gym : <span class="text-light font-weight-bold">{{$coach->gym->name}}</span> </p>
            <p class="card-text text-secondary">City : <span class="text-light font-weight-bold">{{$coach->gym->city->name}}</span> </p>
        </div>
        
    </div>
</div>
@stop

@section('script')
@include('layouts.alertScript')
@stop