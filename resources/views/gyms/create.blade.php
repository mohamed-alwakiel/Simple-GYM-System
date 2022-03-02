@extends('layouts.master')

@section('title')
    Create New Gym
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-5">
                    <form action="{{route('gyms.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="image">Upload Avatar Image</label>
                            <input type="file"  id="image" name="cover_img">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">City Name</label>

                            <select class="form-control" name="city_id">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
