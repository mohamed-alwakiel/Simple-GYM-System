@extends('layouts.master')

@section('title')
    Edit City
@endsection

@section('content')

    <div class="content-wrapper">
        <h1>{{$city['name']}}</h1>
        <div class="container">
            <a href="{{route('cities.index')}}" class="btn btn-success mt-5">Back</a>
            <div class="row">
                <div class="col-12 mt-5">
                    <form action="{{route('cities.update',$city->id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input   type="text" name="name"   value={{$city['name']}} class="form-control" >

                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

