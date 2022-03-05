@extends('layouts.master')

@section('title')
    Update user
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('users.update', $user->id) }}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('put')

            <input type="hidden" name="id" value="{{ $user->id }}">

            {{-- manager name --}}
            <div class="mb-3">
                <label class="form-label"> Client Name </label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- email --}}
            <div class="mb-3">
                <label class="form-label"> Email </label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
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

                    <input name="date_of_birth" type="text" class="form-control" data-inputmask-alias="datetime"
                             data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{$user->date_of_birth}}">

            </div>
            @error('date_of_birth')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="mb-3">
                <label class="form-label"> National ID </label>
                <input type="text" value="{{ $user->national_id }}" name="national_id" class="form-control">
            </div>
            @error('national_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success py-2 px-4">Update</button>
            </div>

        </form>
    </div>
@endsection
