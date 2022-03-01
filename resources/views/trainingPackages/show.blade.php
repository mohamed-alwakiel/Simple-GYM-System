@extends('layouts.app')

@section('title')
view Training Packages
@endsection
@section('content')

<div class="card mt-2">
    <div class="card-header">
        Package Info
    </div>
    <div class="card-body">
        <p class="card-title"><b>Name:-</b> {{ $package->name }}</p>
        <p class="card-text"><b>Price:-</b> <br>{{$package->price}}</p>
        <p class="card-text"><b>Number_of_sessions:-</b> <br>{{$package->number_of_sessions}}</p>
        <p class="card-text"><b>Created at:-</b> <br>{{$package->created_at}}</p>
    </div>
</div>



@endsection
