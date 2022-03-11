@extends('layouts.master')

@section('title', 'Add New Coach')

@section('content')
    <div class=" d-flex justify-content-center">
        <div class="card card-success w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">Add Coach:</h3>
            </div>
            <div class="card-body">

                <form class="px-5 py-3" action="{{ route('coaches.store') }}" method="post">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Coach name</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>

                    {{-- select city and gym --}}
                    @role('admin')
                        {{-- if role Admin --}}
                        <div class="form-group mb-3">
                            <label for="cityName">Select City</label>
                            <select name="city_id" class="form-control" id='cityName'>
                                <option value="0" disable selected="true">=== Select City ===</option>
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

                    {{-- if role city manager --}}
                    @role('gymManager')
                    <input type="hidden" name="gym_id" value="{{ $gyms->id }}">
                    @endrole


                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="d-flex justify-content-end">

                        <button type="submit" class="btn btn-success py-2 px-4">Save</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#cityName').on('change', function(e) {

            var city_id = e.target.value;
            $.get('/json-gym?city_id=' + city_id, function(data) {
                console.log(data);
                $('#gymName').empty();
                $('#gymName').append(
                    '<optione value="0" disabled selected>Select Gym</option>');

                $.each(data, function(index, gymObj) {
                    $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name +
                        '</option>');
                })
            });
        });
    </script>

@endsection
