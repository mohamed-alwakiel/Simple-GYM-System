@extends('layouts.master')
@section('title')
View "{{ $gym->name }}" Branch
@endsection

@section('content')
<div class="container p-5">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Gym Info</h3>
            <div class="card-tools row">
                @role('admin')
                <div class="col-md-4">
                    <a class="btn btn-tool btn-info" href="{{ route('gyms.edit', $gym->id) }}"><i class="fas fa-pencil-alt"></i></a>
                </div>
                <form class="col-md-4" action="{{ route('gyms.destroy', $gym->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                </form>
                @endrole
            </div>
        </div>
        <div class="card-body">
            <p class="card-text text-secondary">Name : <span class="text-light font-weight-bold">{{ $gym->name }}</span> </p>
            <p class="card-text text-secondary">City : <span class="text-light font-weight-bold">{{ $gym->city->name }}</span> </p>
            <p class="card-text text-secondary">City Manager : <span class="text-light font-weight-bold">{{ $gym->city->manager->name }}</span> </p>
        </div>
    </div>
</div>
@stop

@section('script')
@include('layouts.alertScript')
@stop