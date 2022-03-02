@extends('layouts.app')
@section('title') Show @endsection
@section('content')
<div class='container'>
<div class="card mt-5">
  <div class="card-header ">
    Posts
  </div>
  <div class="card-body">
  
   

<div class="row"> <h5 class=" col-3">name : </h5>
    <p class=" col-9 justify-content-start">
      {{ $sessions->name}}

    </p>
    <h5 class=" col-3 justify-content-start">started_at : </h5>
    <p class="card-text col-9">
       {{$sessions->started_at}} </p>

       <h5 class=" col-3">finished_at : </h5>
   <p class="card-text col-9">
   {{$sessions->finished_at}}

   <h5 class=" col-3">Gym : </h5>
   <p class="card-text col-9">
   {{$sessions->gym_id}}

 </p>
</div>
    
  
  
  </div>
</div>


</div>






















@endsection