@extends('layouts.master')

@section('title')
    Create
@endsection



@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>    @endif
    <div class='container '>
        <form method="POST" class='mt-5' action="{{ route('sessions.store') }}" class="mt-5"
            enctype="multipart/form-data">
            @csrf

            <div class="mb-3  mt-5 w-25">
                <label for="name" class="form-label">session name</label>
                <input name="name" type="text" class="form-control" id="name">
            </div>
            <div class="input-group mb-3 w-25">
                <label class="input-group-text" for="inputGroupSelect01">Day</label>
                <select name="day" class="form-select" id="inputGroupSelect01">
                    <option selected>choose</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                </select>
            </div>
            <div class="mb-3 w-25">
                <label for="started_at" class="form-label">started at</label>
                <input name="started_at" type="datetime-local" class="form-control" id="started_at">
            </div>
            <div class="mb-3 w-25">
                <label for="finished_at" class="form-label">finished at</label>
                <input name="finished_at" type="datetime-local" class="form-control" id="finished_at">
            </div>





            <div class="mb-3 w-25">
                <label for="coach" class="form-label">Coaches</label>
                <select multiple name="coach_id[]" id='coach'class="form-control">
                    @foreach ($coaches as $coach)
                        <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3 w-25">
                <label for="gym2" class="form-label">Gym name</label>
                <select  name="gym_id" id='gym2' class="form-control">
                    @foreach ($gyms as $gym)
                        <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                    @endforeach

                </select>
            </div>

            {{-- <div class="mb-3 w-100">
                <label for="gym_id" class="form-label">Gym id</label>
                <input name="gym_id" type="text" class="form-control" id="gym_id">
            </div> --}}

            {{-- <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Post Creator</label>
                <select name="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach

                </select>
                <div>
                    <label for="img" class="form-label">Large file input example</label>
                    <input class="form-control form-control-lg" id="img" name='image' type="file">
                </div>
            </div> --}}
            <button type="submit" class="btn btn-success">create</button>
        </form>
    </div>
@endsection
