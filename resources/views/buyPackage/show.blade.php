@extends('layouts.master')
@section('title', 'Buy Package')

@section('content')
<div class="container p-5">
    <div class="card card-info ">
        <div class="card-header">
            <h3 class="card-title">Purchase Info</h3>

            <div class="card-tools row">
                @role('admin')
                <form class="col-md-4" action="{{ route('buyPackage.destroy', $package->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                </form>
                @endrole
            </div>
            @endrole
        </div>
        <div class="card-body">
            <p class="card-text text-secondary">Package Name : <span class="text-light font-weight-bold">{{$package->package ? $package->package->name : 'not found'}}</span> </p>
            <p class="card-text text-secondary">Paid Price : <span class="text-light font-weight-bold">{{$package->price}}</span> </p>
            <p class="card-text text-secondary">Number of Sessions : <span class="text-light font-weight-bold">{{$package->number_of_sessions}}</span> </p>
            <p class="card-text text-secondary">Purchased at : <span class="text-light font-weight-bold">{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }}</span> </p>
            <p class="card-text text-secondary">Client : <span class="text-light font-weight-bold">{{$package->user ? $package->user->name : 'not found'}}</span> </p>
            <p class="card-text text-secondary">Gym : <span class="text-light font-weight-bold">{{$package->gym ? $package->gym->name : 'not found'}}</span> </p>
        </div>
    </div>
</div>
@stop

@section('script')
@include('layouts.alertScript')
@stop