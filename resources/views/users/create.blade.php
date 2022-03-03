@extends('layouts.master')

@section('title')
    Create user
@endsection

@section('content')
    <div class="pt-2">

        <form class="mt-3 w-50 mx-auto" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- manager name --}}
            <div class="mb-3">
                <label class="form-label"> Client Name </label>
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


            <div class="form-group mb-3">

                <div class="form-group-prepend">
                    <span class="form-group-text">
                        <i class="far fa-calendar-alt"></i>
                        Date of Birth
                    </span>
                </div>

                <input name="date_of_birth" type="text" class="form-control" @error('date_of_birth') is-invalid @enderror"
                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>

            </div>
            @error('date_of_birth')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="form-check mb-3">
                
                <input class="form-check-input" type="radio" name="gender" value="male" id="gender1" checked>
                <label class="form-check-label" for="gender1"> Male </label>
                <input class="form-check-input" type="radio" name="gender" value="female" id="gender2"
                    style=" margin-left:25px">
                <label class="form-check-label" for="gender2" style=" margin-left:45px"> Female </label>
            </div>


            {{-- password --}}
            <div class="mb-3">
                <label class="form-label"> Password </label>
                <input type="password" name="passwd" class="form-control">
            </div>
            @error('passwd')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label class="form-label">Confirm Password </label>
                <input type="password" name="confirmPassword" class="form-control">
            </div>
            @error('confirmPassword')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- national id --}}
            <div class="mb-3">
                <label class="form-label"> National ID </label>
                <input type="number" name="nationalId" class="form-control">
            </div>
            @error('nationalId')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white" id="inputGroupFileAddon01">Profile Iamge</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="profileImg" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose iamge</label>
                </div>
            </div>
            @error('profileImg')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-success py-2 px-4">Save</button>
            </div>
        </form>

    </div>
@endsection
