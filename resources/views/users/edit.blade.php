@extends('layouts.master')

@section('title')
Update user
@endsection

@section('content')

<form method="post" action="{{ route('users.update',$user->id) }}" class="mt-5" style=" margin:0 25px">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $user->id }}">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" >
    <span style="color:red">{{$errors->first("name")}}</span>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
    <span style="color:red">{{$errors->first("email")}}</span>
  </div>
  <div class="form-group">
    <div class="form-group-prepend">
        <span class="form-group-text"><i class="far fa-calendar-alt"></i></span>
    </div>
    <input name="date_of_birth" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{$user->date_of_birth}}">
    <span style="color:red">{{$errors->first("date_of_birth")}}</span>
</div>
  <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" value="male" id="gender1" checked>
        <label class="form-check-label" for="gender1" > Male </label>
        <input class="form-check-input" type="radio" name="gender"  value="female" id="gender2" style=" margin-left:25px" >
        <label class="form-check-label" for="gender2" style=" margin-left:45px"> Female </label>
    </div>
    <br>
  <div class="form-group">
        <label for="national_id">National id</label>
        <input type="text" name="national_id" class="form-control" id="national_id" value="{{$user->national_id}}" >
        <span style="color:red">{{$errors->first("national_id")}}</span>
    </div>
  <button type="submit" class="btn btn-success">Create</button>
</form>

@endsection

