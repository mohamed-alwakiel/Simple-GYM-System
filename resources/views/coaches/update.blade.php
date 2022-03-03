@extends('layouts.master')

@section('title')
    Show
@endsection

@section('content')
    <div class="pt-4">

        <form class="mt-5 w-50 mx-auto" action="{{ route('coaches.update', ['id' => $coaches['id']]) }}" method="post">
            @csrf
            @method('put')

            <input type="hidden" name='id' value="{{ $coaches->id }}">

            <div class="mb-3">
                <label for="name" class="form-label">Title</label>
                <input name="name" id='name' type="text" value="{{ $coaches['name'] }}" class="form-control">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success py-2 px-4">Update</button>
            </div>

        </form>
    </div>
@endsection
