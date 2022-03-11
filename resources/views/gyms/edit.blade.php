@extends('layouts.master')
@section('title')
Edit "{{ $gym->name }}" Branch
@endsection

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-warning w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Edit Gym: <b>{{ $gym->name }}</b></h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('gyms.update', $gym->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Gym Name</label>
                    <input type="text" value="{{ $gym->name }}" name="name" class="form-control">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @role('admin')
                <div class="form-group mb-3">
                    <label">City Name</label>
                        <select class="form-control" name="city_id">
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ $gym->city_id == $city->id ? "SELECTED" : "" }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                </div>
                @endrole

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
                    <button type="submit" class="btn btn-warning py-2 px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop