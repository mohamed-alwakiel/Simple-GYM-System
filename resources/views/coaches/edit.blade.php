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

                    {{-- city --}}
                    <div class="form-group mb-3">
                        <label for="gym_id">City name</label>
                        <select name="_idcity" id='city' class="form-control">
                            @role('admin')
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            @endrole
                            @role('cityManager|gymManager')
                                <option value="{{ $cities->id }}">{{ $cities->name }}</option>
                            @endrole
                        </select>
                    </div>
                    <!-- gyms -->
                    <div class="form-group mb-3">
                        <label for="gym_id">Gym name</label>
                        <select name="gym_id" id='gym' class="form-control">
                            @foreach ($gyms as $gym)
                                <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                            @endforeach
                        </select>
                    </div>

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
        $('#city').on('change', function(e) {

            var city_id = e.target.value;
            $.get('/json-gym?city_id=' + city_id, function(data) {
                console.log(data);
                $('#gym').empty();
                $('#gym').append(
                    '<optione value="0" disabled selected>====== Select Gym ======</option>');

                $.each(data, function(index, gymObj) {
                    $('#gym').append('<option value="' + gymObj.id + '">' + gymObj.name +
                        '</option>');
                })
            });
        });
    </script>
@endsection
