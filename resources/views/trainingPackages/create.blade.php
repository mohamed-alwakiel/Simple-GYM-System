@extends('layouts.master')
@section('title')
    Creating Training Packages
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('trainingPackages.store') }}" method="post">
            @csrf

            <div class="form-group mb-3">

                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="titleHelp">


            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group mb-3">
                <label for="Desc">Price</label>
                <input name="price" type="text" class="form-control" id="price" aria-describedby="titleHelp">

            </div>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group mb-3">
                <label for="num_sessions">Number Of Sessions</label>
                <input name="number_of_sessions" type="text" class="form-control" id="num_sessions"
                    aria-describedby="titleHelp">

            </div>
            @error('number_of_sessions')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-success py-2 px-4">Save</button>
            </div>
        </form>

    </div>
@endsection
