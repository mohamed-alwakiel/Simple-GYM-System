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

        <form method="POST" action="{{ route('coaches.update', ['id' => $coaches['id']]) }}" class="mt-5">
            @csrf
            @method('put')
            <div class="mb-3 w-100">
                <label for="name" class="form-label">Title</label>
                <input name="name" id='name'type="text" value="{{ $coaches['name'] }}" class="form-control"
                    >
            </div>
            

            <input type="hidden" name='id' value="{{ $coaches->id }}">
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
