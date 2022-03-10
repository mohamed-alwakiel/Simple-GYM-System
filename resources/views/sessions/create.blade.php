@extends('layouts.master')

@section('title')
Create
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class='container'>
    @if(session()->has('error'))
    <div class="alert alert-danger col-md-12">
        {{ session()->get('error') }}
    </div>
    @endif
    <form method="POST" action="{{ route('sessions.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Select City -->
        @role('admin')
        <div class="mb-3 w-50">
            <label for="city" class="form-label">City</label>
            <select class="form-control" name="city" id="citySelector">
                <option value="0" disabled selected>Choose City</option>

                @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach

            </select>
        </div>
        @endrole

        <!-- Select Gym -->
        @hasanyrole('admin|cityManager')
        <div class="mb-3 w-50">
            <label for="gym_id" class="form-label">Gym name</label>
            <select  name="gym_id" class="form-control">
                @foreach ($gyms as $gym)
                <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                @endforeach
            </select>
        </div>

        @endhasanyrole

        <!-- Session Name -->
        <div class="mb-3 w-50">
            <label for="name" class="form-label">session name</label>
            <input name="name" type="text" class="form-control" id="name">
        </div>

        <!-- Choose Day -->
        <div class="mb-3 w-50">
            <label class="form-label">Day</label>
            <select name="day" class="form-control" id="inputGroupSelect01">
                <option selected>choose</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
            </select>
        </div>

        <!-- Start -->
        <div class="form-group mb-3 w-50">
            <label class="form-label">Start Session</label>
            <input class="form-control" type="datetime-local"  name="started_at">
        </div>

        <!-- Finish -->
        <div class="form-group mb-3 w-50">
            <label class="form-label">Finish Session</label>
            <input class="form-control" type="datetime-local"  name="finished_at" >
        </div>

        <!-- Coaches -->
        <div class="mb-3 w-50">
            <label for="exampleInputPassword1" class="form-label">Coach</label>
            <select multiple name="coach_id[]" class="form-control">
                @foreach ($coaches as $coach)
                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mb-5">create</button>
    </form>
</div>

<script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function() {
        $('#citySelector').on('change', function() {
            let id = $(this).val();
            $('#gymSelector').empty();
            // $('#gymSelector').append('<option value="0" disabled selected>Processing</option>');
            $.ajax({
                url: '/getGymsBelongsToCity/' + id,

                type: "GET",


                success: function(response) {
                    var response = JSON.parse(response);

                    $('#gymSelector').empty();
                    $('#gymSelector').append(
                        '<option value="0" disabled selected>Select Sub Category</option>'
                    );
                    response.forEach(element => {
                        $('#gymSelector').append(
                            `<option value="${element['id']}">${element['name']}</option>`
                        );
                    });
                }

            });
        });
    });
</script>
@stop
