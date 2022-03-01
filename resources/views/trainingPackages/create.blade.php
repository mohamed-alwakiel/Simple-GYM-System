@extends('layouts.app')
@section('title')
Creating Training Packages
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{route('trainingPackages.store')}}" class="mt-5">
    @csrf
    <div class="form-group m-3">

        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" id="name" aria-describedby="titleHelp">


    </div>

    <div class="form-group m-3">
        <label for="Desc">Price</label>
        <input name="price" type="text" class="form-control" id="price" aria-describedby="titleHelp">

    </div>

    <div class="form-group m-3">
        <label for="num_sessions">Number Of Sessions</label>
        <input name="number_of_sessions" type="text" class="form-control" id="num_sessions" aria-describedby="titleHelp">

    </div>


    <button type="submit" class="btn btn-success m-4">Create</button>
</form>
@endsection