@extends('layouts.master')
@section('title')
    Edit "{{ $coaches->name }}" info
@endsection

@section('content')
    <div class=" d-flex justify-content-center">
        <div class="card card-warning w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">Edit Coach: <b>{{ $coaches->name }}</b></h3>
            </div>
            <div class="card-body">
                <form class="px-5 py-3" action="{{ route('coaches.update', ['id' => $coaches['id']]) }}"
                    method="post">
                    @csrf
                    @method('put')

                    <input type="hidden" name='id' value="{{ $coaches->id }}">

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input name="name" id='name' type="text" value="{{ $coaches['name'] }}" class="form-control">
                    </div>


                    {{-- select city and gym --}}
                    @role('admin')
                        {{-- if role Admin --}}
                        <div class="form-group mb-3">
                            <label for="cityName">Select City</label>
                            <select name="city_id" class="form-control" id='cityName'>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $coaches->gym->city->id == $city->id ? 'SELECTED' : '' }}> {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('city_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group mb-3">
                            <label for="gymName">Select Gym</label>
                            <select name="gym_id" class="form-control" id='gymName'>
                                @foreach ($gyms as $gym)
                                    <option value="{{ $gym->id }}"
                                        {{ $coaches->gym->id == $gym->id ? 'SELECTED' : '' }}> {{ $gym->name }} </option>
                                @endforeach
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
                            <select name="gym_id" class="form-control" id='gymName'>
                                @foreach ($gyms as $gym)
                                    <option value="{{ $gym->id }}"
                                        {{ $coaches->gym->id == $gym->id ? 'SELECTED' : '' }}> {{ $gym->name }} </option>
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
                        <button type="submit" class="btn btn-warning py-2 px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $('#cityName').on('change', function(e) {

            var city_id = e.target.value;
            $.get('/json-gym?city_id=' + city_id, function(data) {
                console.log(data);
                $('#gymName').empty();

                $.each(data, function(index, gymObj) {
                    $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name +
                        '</option>');
                })
            });
        });
    </script>

@endsection
