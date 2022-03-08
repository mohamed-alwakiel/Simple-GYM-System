@extends('layouts.master')

@section('title')
    Create New Gym
@endsection

@section('content')
    <div class="pt-4">
        @error('name', 'cover_img', 'city_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form class="mt-5 w-50 mx-auto" action="{{ route('gyms.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- manager name --}}
            <div class="mb-3">
                <label class="form-label"> Gym Name </label>
                <input type="text" name="name" class="form-control">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white" id="inputGroupFileAddon01">Gym Iamge</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="cover_img" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose iamge</label>
                </div>
            </div>

            @role('admin')
            <div class="form-group">
                <label for="exampleInputPassword1">City Name</label>

                <select class="form-control" name="city_id">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            @endrole


            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-success py-2 px-4">Save</button>
            </div>
        </form>
    </div>
@endsection
