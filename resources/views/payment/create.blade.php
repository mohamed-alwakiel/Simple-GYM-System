@extends('layouts.master')
@section('title')
Payment
@endsection

@section('content')
<div class="pt-4">

    <form class="mt-5 w-50 mx-auto" action="{{ route('buyPackage.store') }}" method="post">
        @csrf

        <div class="form-group m-3">
            <label for="exampleInputPassword1">Trainee</label>
            <select name="user_id" class="form-control">
                @foreach ( $users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group m-3">
            <label for="exampleInputPassword1">package name</label>
            <select name="package_id" class="form-control">
                @foreach ( $packages as $package)
                <option value="{{$package->id}}">{{$package->name}}</option>

                @endforeach
            </select>
        </div>


        <div class="form-group m-3">
            <label for="exampleInputPassword1">Gym</label>
            <select name="gym_id" class="form-control">
                @foreach ( $gyms as $gym)
                <option value="{{ $gym->id }}">{{ $gym->name }}</option>

                @endforeach
            </select>
        </div>


        <div class="d-flex justify-content-end">

            <button type="submit" class="btn btn-success py-2 px-4">Buy</button>
        </div>
    </form>
    <div class="body pt-4">
        {{-- <link rel="stylesheet" href="../../css/style.css"> --}}
        <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
        <script src="https://js.stripe.com/v3/"></script>

        <section class="mt-5 w-50 mx-auto">
            <div class="product">
          
        
        
                <div class="description">
                    <h5>$20.00</h5>
                </div>
            </div>
            <form  action="/create-checkout-session?user=<?php echo $row['name']?>" method="POST">
            @csrf
     
            
                <button class="btn btn-success py-2 px-4" type="submit" id="checkout-button" >Checkout</button>
            </form>
        </section>
    </div>

</div>


@endsection