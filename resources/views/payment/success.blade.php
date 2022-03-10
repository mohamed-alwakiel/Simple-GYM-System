@extends('layouts.master')
@section('title')
Payment
@endsection

@section('content')
<div class="card card-primary w-50 my-5 mx-auto">

    <div class="card-header bg-success">
        <h3 class="card-title">Confirm your payment</h3>
    </div>

    <div class="card-body ">
        <form class="mt-2 w-50 mx-auto " action="{{ route('buyPackage.store') }}" method="post">
            @csrf
            <div class="text-info">
                <div class="row">It is only step to join our Family &#128521;</div>
                <div class="row mt-2">>> click Ok to confirm your payment</div>
            </div>
            <div class="d-flex justify-content-around mt-3">
                <button type="submit" class="btn btn-success bg-success py-2 px-4 ">Ok</button>
                <a class="btn btn-danger bg-danger py-2 px-4 " href="{{ route('buyPackage.cancel') }}">Back</a>
            </div>
        </form>

    </div>
</div>
@endsection