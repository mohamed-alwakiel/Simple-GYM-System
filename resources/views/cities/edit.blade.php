@extends('layouts.master')

@section('title')
    Edit City
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('cities.update', $city->id) }}" method="post">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label class="form-label"> City Name </label>
                <input type="text" value="{{ $city['name'] }}" name="name" class="form-control">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success py-2 px-4">Update</button>
            </div>

        </form>
    </div>
@endsection
