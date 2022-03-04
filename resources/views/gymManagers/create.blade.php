@extends('layouts.master')

@section('title')
    Gym Managers
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('gymManagers.store') }}" method="post"
            enctype="multipart/form-data">
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
                <input type="text" name="national_id" class="form-control"
                    onkeypress="return event.charCode > 47 && event.charCode < 58;" />
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

            {{-- select city and gym --}}
            {{-- if role Admsin --}}
            <div class="form-group">
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

            <div class="form-group">
                <label for="gymName">Select Gym</label>
                <select name="gym_id" class="form-control" id='gymName'>

                </select>
            </div>
            @error('gym_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- if role city manager --}}
            {{-- <div class="form-group">
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
            @enderror --}}


            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-success py-2 px-4">Save</button>
            </div>
        </form>

    </div>

    {{-- scripts --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
@endsection
