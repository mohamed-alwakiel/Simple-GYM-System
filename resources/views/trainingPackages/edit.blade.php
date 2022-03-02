@extends('layouts.master')
@section('title')
Editing Training Packages
@endsection

@section('content')

<form method="POST" action="{{ route('trainingPackages.update',$package->id) }}" method="POST" class="mt-5">
    @csrf
    @method('PUT')
    <input type="hidden" name="package_id" value="{{$package->id}}">
    <div class="form-group m-3">

        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" value="{{ $package->name }}" id="name" aria-describedby="titleHelp">


    </div>
    @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


    <div class="form-group m-3">
        <label for="Desc">Price</label>
        <input name="price" type="text" class="form-control" value="{{ $package->price }}" id="price" aria-describedby="titleHelp">

    </div>
    @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

    <div class="form-group m-3">
        <label for="num_sessions">Number Of Sessions</label>
        <input name="number_of_sessions" type="text" class="form-control" value="{{ $package->number_of_sessions }}" id="num_sessions" aria-describedby="titleHelp">

    </div>
    @error('number_of_sessions')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


    <input type="submit" class="btn btn-success m-4" value="Update">
</form>
@endsection
