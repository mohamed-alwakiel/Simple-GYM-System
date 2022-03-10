@extends('layouts.master')
@section('title')
Edit "{{ $coaches->name }}" info
@endsection
@section('content')
@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-warning w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Edit Coach: <b>{{ $coaches->name }}</b></h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('coaches.update', ['id' => $coaches['id']]) }}" method="post">
                @csrf
                @method('put')

                <input type="hidden" name='id' value="{{ $coaches->id }}">

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input name="name" id='name' type="text" value="{{ $coaches['name'] }}" class="form-control">
                </div>
                
                <div class="form-group mb-3">
                    <label for="gym_id">Gym</label>
                    <input name="gym_id" id='name' type="text" value="{{ $coaches['gym_id'] }}" class="form-control">
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
@endsection