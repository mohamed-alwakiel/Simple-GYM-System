@extends('layouts.master')

@section('title')
    Create
@endsection

@section('content')

    <div class="pt-4">
        <div class="card w-50 m-auto">
            <div class="card-header">
                <h3 class="card-title">Create coach </h3>
            </div>
        <form class="mt-5 w-50 mx-auto" action="{{ route('coaches.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Coach name</label>
                <input name="name" type="text" class="form-control" id="name">
            </div>
{{-- city --}}
            <div class="mb-3 w-50">
                <label for="gym_id" class="form-label">City name</label>
                <select  name="_idcity" id='city' class="form-control">
                    @role('admin')
                    @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                    @endrole
                    @role("cityManager|gymManager")
                    <option value="{{ $cities->id }}">{{ $cities->name }}</option>
                    @endrole
                </select>
            </div>
              <!-- gyms -->
        <div class="mb-3 w-50">
            <label for="gym_id" class="form-label">Gym name</label>
            <select  name="gym_id" id='gym' class="form-control">
                @foreach ($gyms as $gym)
                <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                @endforeach
            </select>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-success py-2 px-4">Save</button>
            </div>
        </form>

    </div>
</div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">



        $('#city').on('change', function(e) {

            var city_id = e.target.value;
            $.get('/json-gym?city_id=' + city_id, function(data) {
                console.log(data);
                $('#gym').empty();
                $('#gym').append(
                    '< valuoptione="0" disable="true" selected="true">Select Gym</option>');

                $.each(data, function(index, gymObj) {
                    $('#gym').append('<option value="' + gymObj.id + '">' + gymObj.name +
                        '</option>');
                })
            });
        });





</script>

@endsection
