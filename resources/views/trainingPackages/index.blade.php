@extends('layouts.master')

@section('title')
    Training Packages
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
        <a href="{{ route('trainingPackages.create') }}" class="btn btn-success my-3">Add New Package</a>
    </div>

    <table class="w-75 mx-auto text-center table-bordered border-2 table-striped ">
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
                <td>{{ $package->id }}</td>
                <td>{{ $package->name }}</td>
                <td>{{ $package->price }}</td>
                <td>{{ $package->number_of_sessions }}</td>
                <td>{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </td>
                <td class="d-flex justify-content-around py-2">
                    <a href="{{ route('trainingPackages.show', ['package' => $package->id]) }}" class="btn btn-info"><i
                            class="fas fa-eye"></i>
                    </a>

                    <form action="{{ route('trainingPackages.destroy', $package->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    </div>


    <!-- /.content-wrapper -->
    <div class="d-flex justify-content-center mb-5"> {!! $packageCollection->links() !!} </div>
@endsection
