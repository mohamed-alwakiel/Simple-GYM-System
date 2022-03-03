@extends('layouts.master')

@section('title')
    Create New City
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('cities.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- manager name --}}
            <div class="mb-3">
                <label class="form-label"> City Name </label>
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
@endsection
