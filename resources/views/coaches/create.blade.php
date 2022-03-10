@extends('layouts.master')

@section('title', 'Add New Coach')

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-success w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Add Coach:</h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('coaches.store') }}" method="post">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Coach name</label>
                    <input name="name" type="text" class="form-control" id="name">
                </div>

                <!-- gyms -->
                <div class="form-group mb-3">
                    <label for="gym_id">Gym name</label>
                    <select name="gym_id" class="form-control">
                        @foreach ($gyms as $gym)
                        <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                        @endforeach
                    </select>
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