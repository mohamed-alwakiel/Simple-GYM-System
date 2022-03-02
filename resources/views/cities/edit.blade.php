@extends('layouts.master')

@section('title')
    Edit City
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container">
            <a href="{{route('cities.index')}}" class="btn btn-success mt-5">Back</a>
            <div class="row">
                <div class="col-12 mt-5">
                    <form action="{{route('cities.update',$city->id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="name"  value={{$city->name}} class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

