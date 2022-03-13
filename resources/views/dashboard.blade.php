@extends('layouts.master')
@section('title', 'Gym Club Dashboard')
@section('content')

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <!-- 1st Row -->
        <div class="row d-flex align-items-center justify-content-center">
            <!-- Profile -->
            <div class="col-md-8">
                <!-- Widget: user widget style 1 -->
                @role('admin|cityManager|gymManager')
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background: url('../dist/img/photo1.png') center center;">

                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('imgs/users/' . Auth::user()->profile_img) }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-sm bg-dark">Edit Profile</a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h3 class="description-header text-warning">{{ Auth::user()->name }}</h3>
                                    @role('admin')
                                    <span class="description-text text-secondary">Owner Of Gym Club</span>
                                    @endrole
                                    @role('cityManager')
                                    <span class="description-text text-secondary"><b>{{ auth()->user()->city->name }}</b><br> City Manager</span>
                                    @endrole
                                    @role('gymManager')
                                    <span class="description-text text-secondary">{{ auth()->user()->gym->name }} <br> Branch Manager</span>
                                    @endrole
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <a href="{{ route('attendance.index') }}" class="btn btn-sm bg-dark">Show Attendance</a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                @endrole
                <!-- /.widget-user -->

                @role('client')
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background: url('../dist/img/photo1.png') center center;">
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('imgs/users/' . Auth::user()->profile_img) }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <a href="{{ route('profile.edit',auth()->user()->id) }}" class="btn btn-sm bg-dark">Edit Profile</a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header text-warning">{{ Auth::user()->name }}</h5>
                                    <span class="description-text">Welcome Back !!</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <a href="{{ route('attendance.index') }}" class="btn btn-sm bg-dark">Show Attendance</a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                @endrole
            </div>

            <!-- 3 Statistics  -->
            @hasanyrole('admin|cityManager|gymManager')
            <div class="col-md-4">
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Revenue</span>
                            <span class="info-box-number">
                                $ {{$paidPrice}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box mb-3">
                    <!-- <i class="fad fa-credit-card-front"></i> -->
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-credit-card"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Purchased Packages</span>
                            <span class="info-box-number">{{$boughtPackagesCount}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Trainees</span>
                            <span class="info-box-number">{{$allClientsCount}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            @endhasanyrole
            <!-- /.col -->
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <!-- /.row -->

    </div>
    <!--/. container-fluid -->
</section>


<!-- /.content -->
@endsection
