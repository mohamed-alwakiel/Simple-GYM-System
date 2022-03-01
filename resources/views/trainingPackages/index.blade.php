@extends('layouts.master')

@section('title')
Training Packages
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content text-center p-3">

    <a href="{{ route('trainingPackages.create')}}" class="btn btn-primary">Add Package</a>
    
    <table class="table mt-5">
        <thead>

            <tr>
                <th class="col-2">id</th>
                <th class="col-2">name</th>
                <th class="col-2">price</th>
                <th class="col-2">Number Of Sessions</th>
                <th class="col-2">Created At</th>
                <th class="col-2">Actions</th>
            </tr>
        </thead>
        @foreach ($packageCollection as $package)
        <tr>
            <td>{{$package->id}}</td>
            <td>{{$package->name}}</td>
            <td>{{$package->price}}</td>
            <td>{{$package->number_of_sessions}}</td>
            <td>{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </td>
            <td> <a href="{{ route('trainingPackages.show', ['package' => $package->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>


</div>


<!-- /.content-wrapper -->
<div class="d-flex justify-content-center mb-5"> {!! $packageCollection->links() !!} </div>
@endsection