@extends('layouts.master')
@section('title', "View Client Information")

@section('content')
<div class="container p-5">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Client Info : <b>{{ $user->name }}</b></h3>

            <div class="card-tools row">
                @role('admin|cityManager|gymManager')
                <form class="col-md-4" action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                </form>
                @endrole
            </div>
        </div>
        <div class="card-body">
            <p class="card-text text-secondary">Name : <span class="text-light font-weight-bold">{{$user->name}}</span> </p>
            <p class="card-text text-secondary">Email : <span class="text-light font-weight-bold">{{$user->email}}</span> </p>
            <p class="card-text text-secondary">DOB : <span class="text-light font-weight-bold">{{$user->date_of_birth}}</span> </p>
            <p class="card-text text-secondary">Gender : <span class="text-light font-weight-bold">{{$user->gender}}</span> </p>
            <p class="card-text text-secondary">National ID : <span class="text-light font-weight-bold">{{$user->national_id}}</span> </p>
            <p class="card-text text-secondary">City : <span class="text-light font-weight-bold">{{$user->gym->city->name}}</span> </p>
            <p class="card-text text-secondary">Gym : <span class="text-light font-weight-bold">{{$user->gym->name}}</span> </p>
        </div>
    </div>
</div>
@stop

@section('script')
@include('layouts.alertScript')
@stop