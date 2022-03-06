@extends('layouts.master')

@section('title', 'Training Packages')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

@endsection

@section('content')
    <div class="container">
        <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
            <a href="{{ route('trainingPackages.create') }}" class="btn btn-success my-3">Add New Package</a>
        </div>
        <div class="row">

            <table id="table_id" class="display">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>No Of Sessions</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody style=" color: #0a0e14">
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
    </div>

@endsection
@section('script')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script  >
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>

@endsection
