@extends('layouts.master')
@section('title', 'Add New Client')

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-success w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Add New Client:</h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- manager name --}}
                <div class="form-group mb-3">
                    <label>Client Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', '') }}">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- email --}}
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', '') }}">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- DOB --}}
                <div class="form-group mb-3">
                    <label>Date of Birth</label>
                    <input class="form-control" type="date" name="date_of_birth">
                </div>
                @error('date_of_birth')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Gender --}}
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="gender" value="male" id="gender1" checked>
                    <label class="form-check-label" for="gender1"> Male </label>
                    <input class="form-check-input" type="radio" name="gender" value="female" id="gender2" style=" margin-left:25px">
                    <label class="form-check-label" for="gender2" style=" margin-left:45px"> Female </label>
                </div>

                {{-- password --}}
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="password" name="passwd" class="form-control" value="{{ old('passwd', '') }}">
                </div>
                @error('passwd')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control" value="{{ old('confirmPassword', '') }}">
                </div>
                @error('confirmPassword')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- national id --}}
                <div class="form-group mb-3">
                    <label>National ID</label>
                    <input type="text" name="national_id" class="form-control" onkeypress="return event.charCode > 47 && event.charCode < 58;" value="{{ old('national_id', '') }}" />
                </div>
                @error('national_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- select city and gym --}}
                @role('admin')
                {{-- if role Admin --}}
                <div class="form-group mb-3">
                    <label for="cityName">Select City</label>
                    <select name="city_id" class="form-control" id='cityName'>
                        <option value="0" disable="true" selected="true">=== Select City ===</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}"> {{ $city->name }} </option>
                        @endforeach
                    </select>
                </div>
                @error('city_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="gymName">Select Gym</label>
                    <select name="gym_id" class="form-control" id='gymName'>
                    </select>
                </div>
                @error('gym_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @endrole

                {{-- if role city manager --}}
                @role('cityManager')
                <div class="form-group">
                    <label for="gymName">Select Gym</label>
                    <select name="gym_id" class="form-control">
                        <option value="0" disable="true" selected="true">=== Select Gym ===</option>
                        @foreach ($gyms as $gym)
                        <option value="{{ $gym->id }}"> {{ $gym->name }} </option>
                        @endforeach
                    </select>
                </div>
                @error('gym_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @endrole

                {{-- profile img --}}
                <div class="">
                    <div class="w-100">
                        <label for="">Profile Image</label>
                        <input type="file" class="form-control w-100 bg-dark pt-1" name="profileImg" aria-describedby="fileHelpId" value="{{ old('profileImg', '') }}">
                        <small id="fileHelpId" class="form-text text-muted">only : png or jpg</small>
                    </div>
                </div>
                @error('img')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success py-2 px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

{{-- scripts --}}
@section('script')
<script type="text/javascript">
    $('#cityName').on('change', function(e) {
        console.log(e);
        var city_id = e.target.value;
        $.get('/json-gym?city_id=' + city_id, function(data) {
            console.log(data);
            $('#gymName').empty();
            $('#gymName').append(
                '<option value="0" disable="true" selected="true">=== Select Gym ===</option>');

            $.each(data, function(index, gymObj) {
                $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name +
                    '</option>');
            })
        });
    });
</script>
@stop
