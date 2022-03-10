@extends('layouts.master')
@section('title')
Edit "{{ $gymManager->name }}" info
@endsection
@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-warning w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Edit Gym Manager: <b>{{ $gymManager->name }}</b></h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('gymManagers.update', $gymManager->id) }}" method="post">
                @csrf
                @method('put')

                <input type="hidden" name="id" value="{{ $gymManager->id }}">

                <div class="form-group mb-3">
                    <label>Manager Name</label>
                    <input type="text" value="{{ $gymManager->name }}" name="name" class="form-control">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" value="{{ $gymManager->email }}" name="email" class="form-control">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label>National ID</label>
                    <input type="text" name="national_id" class="form-control" value="{{ $gymManager->national_id }}" onkeypress="return event.charCode > 47 && event.charCode < 58;" />
                </div>
                @error('national_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label>Gym</label>
                    <select name="gym_id" class="form-control">
                        @foreach ($gyms as $gym)
                        <option value="{{ $gym->id }}" {{ $gymManager->gym_id == $gym->id ? 'SELECTED' : '' }}>
                            {{ $gym->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning py-2 px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection