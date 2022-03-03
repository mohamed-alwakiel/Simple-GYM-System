@extends('layouts.master')

@section('title')
    Create
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('coaches.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Coach name</label>
                <input name="name" type="text" class="form-control" id="name">
            </div>
            
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-success py-2 px-4">Save</button>
            </div>
        </form>

    </div>
@endsection
