@extends('layouts.master')
@section('title')
View "{{ $city->name }}" City
@endsection

@section('content')
<div class="container p-5">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">City Info</h3>
            <div class="card-tools row">
                <!-- This will cause the card to be Edited when clicked -->
                <div class="col-md-4">
                    <a class="btn btn-tool btn-info" href="{{ route('cities.edit', $city->id) }}"><i class="fas fa-pencil-alt"></i></a>
                </div>
                <!-- This will cause the card to be removed when clicked -->
                <form class="col-md-4" action="{{ route('cities.destroy', $city->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text text-secondary">Name : <span class="text-light font-weight-bold">{{ $city->name }}</span> </p>
            <p class="card-text text-secondary">Manager : <span class="text-light font-weight-bold">{{ $city->manager ? $city->manager->name : 'No Manager !' }}</span> </p>
        </div>
    </div>
</div>
@stop

@section('script')
@include('layouts.alertScript')
@stop


