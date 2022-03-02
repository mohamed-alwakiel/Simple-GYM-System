@extends('layouts.master')
@section('title')
Creating Training Packages
@endsection

@section('content')

<form method="POST" action="{{route('trainingPackages.store')}}" class="mt-5">
    @csrf
    <div class="form-group m-3">

        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" id="name" aria-describedby="titleHelp">


    </div>
    @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

    <div class="form-group m-3">
        <label for="Desc">Price</label>
        <input name="price" type="text" class="form-control" id="price" aria-describedby="titleHelp">

    </div>
    @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

    <div class="form-group m-3">
        <label for="num_sessions">Number Of Sessions</label>
        <input name="number_of_sessions" type="text" class="form-control" id="num_sessions" aria-describedby="titleHelp">

    </div>
    @error('number_of_sessions')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

    <button type="submit" class="btn btn-success m-4">Create</button>
</form>
@endsection