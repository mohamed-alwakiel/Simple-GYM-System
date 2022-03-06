@extends('layouts.master')

@section('title', 'Users')


@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                        <p class="text-muted text-center">Software Engineer</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <form class="mt-5 w-50 mx-auto" action="{{ route('users.updateProfile',auth()->user()->id) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">


                            <div class="mb-3">
                                <label class="form-label"> Name </label>
                                <input type="text" value="{{ auth()->user()->name }}" name="name" class="form-control">
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label class="form-label"> Email </label>
                                <input type="email" value="{{ auth()->user()->email }}" name="email" class="form-control">
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label class="form-label"> National ID </label>
                                <input type="text" name="national_id" class="form-control" value="{{ auth()->user()->national_id }}" onkeypress="return event.charCode > 47 && event.charCode < 58;" />
                            </div>
                            @error('national_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{--
                    <div class="mb-3">
                        <label class="form-label">Gym</label>

                        <select name="gym_id" class="form-control">

                            @foreach ($gyms as $gym)
                            <option value="{{ $gym->id }}" {{ $gymManager->gym_id == $gym->id ? 'SELECTED' : '' }}>
                            {{ $gym->name }}
                            </option>
                            @endforeach

                            </select>

                    </div>
                    --}}

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success py-2 px-4">Update</button>
                    </div>

                    </form> <!-- /.card -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->



@endsection