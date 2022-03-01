@extends('layouts.app')
@section('title')
Editing Training Packages
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
<form method="POST" action="{{ route('trainingPackages.update',$package->id) }}" method="POST" class="mt-5">
    @csrf
    @method('PUT')
    <input type="hidden" name="package_id" value="{{$package->id}}">
    <div class="form-group m-3">

        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" value="{{ $package->name }}" id="name" aria-describedby="titleHelp">


    </div>

    <div class="form-group m-3">
        <label for="Desc">Price</label>
        <input name="price" type="text" class="form-control" value="{{ $package->price }}" id="price" aria-describedby="titleHelp">

    </div>

    <div class="form-group m-3">
        <label for="num_sessions">Post Creator</label>
        <input name="number_of_sessions" type="text" class="form-control" value="{{ $package->number_of_sessions }}" id="num_sessions" aria-describedby="titleHelp">

    </div>

    <input type="submit" class="btn btn-success m-4" value="Update">
</form>
@endsection
