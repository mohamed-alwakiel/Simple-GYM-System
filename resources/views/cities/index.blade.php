@extends('layouts.master')

@section('title', 'cities')


@section('content')

    <div class="container w-50">
        <div class="mx-auto pt-3 d-flex justify-content-end">
            <div>
        <a href="{{ route('cities.create') }}" class="btn btn-success my-3">Add New City</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Cities</h3>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="table text-center ">



                            <thead>

                            <tr>
                                <th>Name</th>

                                <th>Controllers</th>
                            </tr>
                            </thead>


                            <tbody>

            @foreach ($cities as $city)
                <tr class="bg-dark">
                    <th>{{ $city->name }}</th>

                    <th class="d-flex justify-content-around py-2">
                        <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-primary">Update</a>

                        <form action="{{ route('cities.destroy', $city->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>
                        </form>

                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
