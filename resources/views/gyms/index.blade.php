@extends('layouts.master')

@section('title', 'Gyms')


@section('content')

    <div class="container w-75">
        <div class="mx-auto pt-3 d-flex justify-content-end">
            <div>
                <a href="{{ route('gyms.create') }}" class="btn btn-success my-3">Add New Gym</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Gyms</h3>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="table text-center ">



        <thead>
            <tr>
                <th>Name</th>
                <th>Cover Image</th>
                @role('admin')
                <th>City Name</th>
                @endrole
                <th>Controllers</th>
            </tr>
        </thead>


        <tbody>
            @foreach ($gyms as $gym)
                <tr class="bg-dark">
                    <th>{{ $gym->name }}</th>

                    <th>
                        <img src="{{ url('imgs/gym/' . $gym->cover_img) }} " width="50px" height="50px" alt="not found" />
                    </th>
                    @role('admin')
                    <th>
                        {{ $gym->city->name }}

                    </th>
                    @endrole

                    <th class="d-flex justify-content-around py-2">
                        <a href="{{ route('gyms.edit', $gym->id) }}" class="btn btn-primary">Update</a>

                        <form action="{{ route('gyms.destroy', $gym->id) }}" method="post">
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
