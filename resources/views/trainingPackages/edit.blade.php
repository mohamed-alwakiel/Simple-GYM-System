@extends('layouts.master')
@section('title')
    Editing Training Packages
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('trainingPackages.update', $package->id) }}" method="post">
            @csrf
            @method('put')


            <input type="hidden" name="package_id" value="{{ $package->id }}">
            <div class="form-group mb-3">

                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" value="{{ $package->name }}" id="name"
                    aria-describedby="titleHelp" disabled>


            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="form-group mb-3">
                <label for="Desc">Price</label>
                <input name="price" type="text" class="form-control" value="{{ $package->price }}" id="price"
                    aria-describedby="titleHelp">

            </div>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group mb-3">
                <label for="num_sessions">Number Of Sessions</label>
                <input name="number_of_sessions" type="text" class="form-control"
                    value="{{ $package->number_of_sessions }}" id="num_sessions" aria-describedby="titleHelp">

            </div>
            @error('number_of_sessions')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success py-2 px-4">Update</button>
            </div>

        </form>
    </div>
@endsection
