@extends('layouts.master')

@section('title')
    Edit Gym
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('gyms.update', $gym->id) }}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('patch')


            <div class="mb-3">
                <label class="form-label"> Gym Name </label>
                <input type="text" value="{{ $gym->name }}" name="name" class="form-control">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @role('admin')
            <div class="form-group">
                <label for="exampleInputPassword1">City Name</label>
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
                    <input type="file" class="form-control-file w-100 bg-dark " name="cover_img"
                        aria-describedby="fileHelpId" value="{{ old('cover_img', '') }}">
                    <small id="fileHelpId" class="form-text text-muted">only : png or jpg</small>
                </div>
            </div>
            @error('cover_img')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="d-flex justify-content-end">
                 <button type="submit" class="btn btn-success py-2 px-4">Update</button>
             </div>

         </form>
     </div>
@endsection
