@extends('layouts.master')
@section('title')
Edit "{{ $package->name }}" Package
@stop

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-warning w-50 mt-5">
        <div class="card-header">
            <h3 class="card-title">Edit Package: <b>{{ $package->name }}</b></h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('trainingPackages.update', $package->id) }}" method="post">
                @csrf
                @method('put')

                <input type="hidden" name="package_id" value="{{ $package->id }}">

                <div class="form-group mb-3">
                    <label for="Desc">Price $</label>
                    <input name="price" type="text" class="form-control" value="{{ $package->price /100 }} " id="price" aria-describedby="titleHelp">
                </div>
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="num_sessions">Number Of Sessions</label>
                    <input name="number_of_sessions" type="text" class="form-control" value="{{ $package->number_of_sessions }}" id="num_sessions" aria-describedby="titleHelp">
                </div>
                @error('number_of_sessions')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning py-2 px-4">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>
@stop