@extends('layouts.master')

@section('title')
Training Packages
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper text-center p-5">

    <a href="{{ route('trainingPackages.create')}}" class="btn btn-primary">Add Package</a>
    
    <table class="table mt-5 pl-3">
        <thead>

            <tr>
                <th class="col-1">id</th>
                <th class="col-2">name</th>
                <th class="col-2">price</th>
                <th class="col-2">number_of_sessions</th>
                <th class="col-2">Created At</th>
                <th class="col-3">Actions</th>
            </tr>
        </thead>
        @foreach ($packageCollectionView as $package)
        <tr>
            <td>{{$package->id}}</td>
            <td>{{$package->name}}</td>
            <td>{{$package->price}}</td>
            <td>{{$package->number_of_sessions}}</td>
            <td>{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </td>
            <td class="row d-flex justify-content-between">
                <a href="{{ route('trainingPackages.show', ['package' => $package->id]) }}" class="btn btn-info col-md-3">view</a>
                <a href="{{ route('trainingPackages.edit', ['package' => $package->id]) }}" class="btn btn-primary col-md-3">Edit</a>

                <form class="col-md-2" action="{{ route('trainingPackages.destroy',$package->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <div class="col-md-2">
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                    </div>
                </form>

            </td>
        </tr>
        @endforeach
        </tbody>
    </table>


</div>


<!-- /.content-wrapper -->
<div class="d-flex justify-content-center mb-5"> {!! $packageCollectionView->links() !!} </div>
@endsection