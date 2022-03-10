@extends('layouts.master')
@section('title', 'Create New City')

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-success w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Add City:</h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('cities.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- manager name --}}
                <div class="form-group mb-3">
                    <label>City Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success py-2 px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop