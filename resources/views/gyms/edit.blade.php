@extends('layouts.master')

@section('title')
    Edit Gym
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('gyms.update', $gym->id) }}" method="post">
            @csrf
            @method('patch')


            <div class="mb-3">
                <label class="form-label"> Gym Name </label>
                <input type="text" value="{{ $gym->name }}" name="name" class="form-control">
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


            <div class="form-group">
                <label for="exampleInputPassword1">City Name</label>
                <select class="form-control" name="city_id">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $gym->city_id == $city->id ? "SELECTED" : "" }}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end">
                 <button type="submit" class="btn btn-success py-2 px-4">Update</button>
             </div>

         </form>
     </div>
@endsection
