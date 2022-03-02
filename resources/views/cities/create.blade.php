@extends('layouts.master')

@section('title')
    Create New City
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-5">
                    <form action="{{route('cities.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('name')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
</div>

@endsection
