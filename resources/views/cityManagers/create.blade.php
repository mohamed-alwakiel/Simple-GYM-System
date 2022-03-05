@extends('layouts.master')

@section('title')
    City Managers
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('cityManagers.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- manager name --}}
            <div class="mb-3">
                <label class="form-label"> Manager Name </label>
                <input type="text" name="name" class="form-control">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- email --}}
            <div class="mb-3">
                <label class="form-label"> Email </label>
                <input type="email" name="email" class="form-control">
            </div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- password --}}
            <div class="mb-3">
                <label class="form-label"> Password </label>
                <input type="password" name="password" class="form-control">
            </div>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- national id --}}
            <div class="mb-3">
                <label class="form-label"> National ID </label>
                <input type="number" name="national_id" class="form-control">
            </div>
            @error('national_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- profile img --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white" id="inputGroupFileAddon01">Profile Iamge</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="img" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose iamge</label>
                </div>
            </div>


            <div class="mb-3">
                <label class="form-label">City</label>

                <select name="city_id" class="form-control">

                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">
                            {{ $city->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-success py-2 px-4">Save</button>
            </div>
        </form>


    </div>

@endsection
