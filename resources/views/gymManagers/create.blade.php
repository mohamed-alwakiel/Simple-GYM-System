@extends('layouts.master')
@section('title', 'Add New Gym Manager')

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-success w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Add New Gym Manager:</h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('gymManagers.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- manager name --}}
                <div class="form-group mb-3">
                    <label> Manager Name </label>
                    <input type="text" name="name" class="form-control">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- email --}}
                <div class="form-group mb-3">
                    <label> Email </label>
                    <input type="email" name="email" class="form-control">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- password --}}
                <div class="form-group mb-3">
                    <label> Password </label>
                    <input type="password" name="password" class="form-control">
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- national id --}}
                <div class="form-group mb-3">
                    <label> National ID </label>
                    <input type="text" name="national_id" class="form-control" onkeypress="return event.charCode > 47 && event.charCode < 58;" />
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
                        <option value="0" disabled selected="true">=== Select City ===</option>
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
                <div class="form-group mb-3">
                    <label for="gymName">Select Gym</label>
                    <select name="gym_id" class="form-control">
                        <option value="0" disabled selected="true">=== Select Gym ===</option>
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
                        <input type="file" class="form-control w-100 bg-dark " name="img" aria-describedby="fileHelpId">
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
        var city_id = e.target.value;
        $.get('/json-gym?city_id=' + city_id, function(data) {
            $('#gymName').empty();
            $('#gymName').append(
                '<option value="0" disabled selected="true">=== Select Gym ===</option>');

            $.each(data, function(index, gymObj) {
                $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name +
                    '</option>');
            })
        });
    });
</script>
@stop