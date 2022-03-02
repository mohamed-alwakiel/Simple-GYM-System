@extends('layouts.master')
@section('title')
view Training Packages
@endsection
@section('content')
<div class="container p-5">
<div class="card card-danger ">
    <div class="card-header">
        <h3 class="card-title">Package Info</h3>

        <div class="card-tools row">
            <!-- This will cause the card to maximize when clicked -->
            <div class="col-md-4">
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
            <!-- This will cause the card to be Edited when clicked -->
            <div class="col-md-4">
            <a class="btn btn-tool btn-danger" href="{{ route('trainingPackages.edit', ['package' => $package->id]) }}"><i class="fas fa-pencil-alt"></i></a>
            <!-- This will cause the card to be removed when clicked -->
            </div>
            <form class="col-md-4" action="{{ route('trainingPackages.destroy',$package->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-tool"><i class="fas fa-times"></i></button>

            </form>
        </div>
    </div>
    <div class="card-body">
        <p class="card-title mb-3"><b>Name:- </b> {{ $package->name }}</p>
        <p class="card-text"><b>Price:- </b> {{$package->price}}</p>
        <p class="card-text"><b>Number Of Sessions:- </b> {{$package->number_of_sessions}}</p>
        <p class="card-text"><b>Created at:- </b> {{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }}</p>
    </div>
</div>
</div>

@endsection