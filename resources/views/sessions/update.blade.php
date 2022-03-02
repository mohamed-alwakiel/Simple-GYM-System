@extends('layouts.master')

@section('title')
    Show
@endsection

@section('content')
    {{-- @error('title')
        <div class='alert-danger'>

            {{ $message }}



        </div>
    @enderror --}}
    <div class='container col-6'>

        <form method="POST" action="{{ route('sessions.update', ['id' => $session['id']]) }}" class="mt-5">
            @csrf
            @method('put')
            <div class="mb-3 w-100">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input name="name" type="text" value="{{ $session['name'] }}" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <textarea name="started_at" class="form-control">{{ $session['started_at'] }}</textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <textarea name="finished_at" class="form-control">{{ $session['finished_at'] }}</textarea>
            </div>


            <input type="hidden" name='id' value="{{ $session->id }}">
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
