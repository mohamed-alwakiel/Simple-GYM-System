@extends('layouts.master')
@section('title')
Edit "{{ $city->name }}" City
@endsection

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-warning w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Edit City: <b>{{ $city->name }}</b></h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('cities.update', $city->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>City Name</label>
                    <input type="text" value="{{ $city['name'] }}" name="name" class="form-control">
                </div>
                @error('name')
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