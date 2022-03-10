@extends('layouts.master')

@section('title', 'Create Gym City')

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-success w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Add City:</h3>
        </div>
        <div class="card-body">
            @error('name', 'cover_img', 'city_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <form class="px-5 py-3" action="{{ route('gyms.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- manager name --}}
                <div class="form-group mb-3">
                    <label>Gym Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @role('admin')
                <div class="form-group mb-3">
                    <label>City Name</label>
                    <select class="form-control" name="city_id">
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endrole

                {{-- gym img --}}
                <div class="">
                    <div class="w-100">
                        <label for="">Gym Image</label>
                        <input type="file" class="form-control w-100 bg-dark " name="cover_img" aria-describedby="fileHelpId" value="{{ old('cover_img', '') }}">
                        <small id="fileHelpId" class="form-text text-muted">only : png or jpg</small>
                    </div>
                </div>
                @error('cover_img')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success py-2 px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection