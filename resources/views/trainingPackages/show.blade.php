@extends('layouts.master')
@section('title')
    View "{{ $package->name }}" Package
@endsection

@section('content')
    <div class="container p-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Package Info</h3>
                @role('admin')
                    <div class="card-tools row">
                        <!-- This will cause the card to be Edited when clicked -->
                        <div class="col-md-4">
                            <a class="btn btn-tool btn-info"
                                href="{{ route('trainingPackages.edit', ['package' => $package->id]) }}"><i
                                    class="fas fa-pencil-alt"></i></a>
                        </div>
                        <!-- This will cause the card to be removed when clicked -->
                        <form class="col-md-4" action="{{ route('trainingPackages.destroy', $package->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool"
                                data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                        </form>
                    </div>
                @endrole
            </div>
            <div class="card-body">
                <p class="card-text text-secondary">Name : <span
                        class="text-light font-weight-bold">{{ $package->name }}</span> </p>
                <p class="card-text text-secondary">Price : <span
                        class="text-light font-weight-bold">{{ $package->price / 100 }} $</span> </p>
                <p class="card-text text-secondary">Number Of Sessions : <span
                        class="text-light font-weight-bold">{{ $package->number_of_sessions }}</span> </p>
                <p class="card-text text-secondary">Created at :<span
                        class="text-light font-weight-bold">{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }}
                    </span> </p>
            </div>
        </div>
    </div>
@stop

    @include('layouts.alertScript')
