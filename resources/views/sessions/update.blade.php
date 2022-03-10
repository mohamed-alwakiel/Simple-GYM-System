@extends('layouts.master')

@section('title')
    Edite Session
@endsection


@section('content')

@if ($errors)
<div class="alert alert-danger">
    <ul>

        <li>{{"time overlap with other sessions "}}</li>

    </ul>
</div>
@endif

    <div class='container '>
        <form method="POST" action="{{ route('sessions.update', ['id' => $session['id']]) }}" class="mt-5">
            @csrf
            @method('put')


            <div class="mb-3 w-25">
                <label for="started_at" class="form-label">started at</label>
                <input name="started_at" type="datetime-local" value="{{ $session['started_at'] }}" class="form-control" id="started_at">
            </div>
            <div class="mb-3 w-25">
                <label for="finished_at" class="form-label">finished at</label>
                <input name="finished_at" type="datetime-local"  value="{{ $session['finished_at'] }}" class="form-control" id="finished_at">
            </div>



            <button type="submit" class="btn btn-success">update</button>
        </form>
    </div>
@endsection










