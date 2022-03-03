use App\Models\User;
use App\Models\Gym;
use App\Models\City;

@extends('layouts.master')

@section('title')
Create user
@endsection

@section('content')

<form method="POST" action="{{route('users.store')}}" class="mt-5" enctype="multipart/form-data" style=" margin:0 25px">
    @csrf
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{old('name','')}}" >
    <span style="color:red">{{$errors->first("name")}}</span>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" id="email" value="{{old('email','')}}">
    <span style="color:red">{{$errors->first("email")}}</span>
  </div>
  <div class="form-group">
    <div class="form-group-prepend">
        <span class="form-group-text"><i class="far fa-calendar-alt"></i></span>
    </div>
    <input name="date_of_birth" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask placeholder="Date of Birth">
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
        <label for="nationalId">National id</label>
        <input type="text" name="national_id" class="form-control" id="national_id" value="{{old('national_id','')}}" >
        <span style="color:red">{{$errors->first("national_id")}}</span>
    </div>
  <div class="form-group">
    <label for="passwd">Password</label>
    <input type="password" name="passwd" class="form-control" id="passwd" value="{{old('passwd','')}}" >
    <span style="color:red">{{$errors->first("password")}}</span>
  </div>
  <div class="form-group">
    <label for="confirmPassword">Confirm Password </label>
    <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" value="{{old('confirmPassword','')}}">
    <span style="color:red">{{$errors->first("confirmPassword")}}</span>
  </div>
  <div class="form-group">
    <label for="profileImg">Profile Image</label>
    <input type="file" name="profileImg" class="form-control" id="profileImg" value="{{old('profileImg','')}}" >
    <span style="color:red">{{$errors->first("profileImg")}}</span>
  </div>
  <div class="form-group">
    <label for="cityName">Select City</label>
    <select name="city_id" class="form-control" id='cityName' >
    <option value="0" disable="true" selected="true">=== Select City ===</option>
        @foreach($cities as $city)
        <option value="{{$city->id}}"> {{$city->name}} </option>
        @endforeach
    </select>
    <span style="color:red">{{$errors->first("city_id")}}</span>
  </div>
  <div class="form-group">
    <label for="gymName">Select Gym</label>
    <select name="gym_id" class="form-control" id='gymName' >

    </select>
    <span style="color:red">{{$errors->first("gym_id")}}</span>
  </div>
  <button type="submit" class="btn btn-success">Create</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $('#cityName').on('change', function(e){
        console.log(e);
        var city_id = e.target.value;
        $.get('/json-gym?city_id=' + city_id,function(data) {
          console.log(data);
          $('#gymName').empty();
          $('#gymName').append('<option value="0" disable="true" selected="true">=== Select Gym ===</option>');

          $.each(data, function(index, gymObj){
            $('#gymName').append('<option value="'+ gymObj.id +'">'+ gymObj.name +'</option>');
          })
        });
      });
  </script>



</form>



@endsection


