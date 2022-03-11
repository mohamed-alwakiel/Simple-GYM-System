@extends('layouts.master')
@section('title')
Edit "{{ $cityManager->name }}" info
@endsection
@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-warning w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Edit City Manager: <b>{{ $cityManager->name }}</b></h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('cityManagers.update', $cityManager->id) }}" method="post">
                @csrf
                @method('put')

                <input type="hidden" name="id" value="{{ $cityManager->id }}">

                <div class="form-group mb-3">
                    <label>Manager Name</label>
                    <input type="text" value="{{ $cityManager->name }}" name="name" class="form-control">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label> Email </label>
                    <input type="email" value="{{ $cityManager->email }}" name="email" class="form-control">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label> National ID </label>
                    <input type="text" name="national_id" class="form-control" value="{{ $cityManager->national_id }}" onkeypress="return event.charCode > 47 && event.charCode < 58;" />
                </div>
                @error('national_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label>City</label>
                    <select name="city_id" class="form-control">
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $cityManager->city_id == $city->id ? 'SELECTED' : '' }}>
                            {{ $city->name }}
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
@stop