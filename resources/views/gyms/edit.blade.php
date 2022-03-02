@extends('layouts.master')

@section('title')
    Edit Gym
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container">
            <a href="{{route('gyms.index')}}" class="btn btn-success mt-5">Back</a>
            <div class="row">
                <div class="col-12 mt-5">

                    <form action="{{route('gyms.update',$gym->id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="name"  value={{$gym->name}} class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">City Name</label>
                            <select class="form-control" name="city_id">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

