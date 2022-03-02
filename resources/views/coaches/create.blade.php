@extends('layouts.master')

@section('title')
    Create
@endsection

@section('content')

    <div class='container '>
        <form method="POST" class='mt-5' action="{{ route('coaches.store') }}" class="mt-5" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3 w-100 mt-5">
                <label for="name" class="form-label">Coach name</label>
                <input name="name" type="text" class="form-control" id="name">
           
            <button type="submit" class="btn btn-success">Add</button>
        </form>
    </div>
@endsection
