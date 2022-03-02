@extends('layouts.master')

@section('title', 'cities')


@section('content')


    <div class="w-50 mx-auto pt-3 d-flex justify-content-end">
        <a href="{{ route('cities.create') }}" class="btn btn-success my-3">Add New City</a>
    </div>

    <table class="w-50 mx-auto text-center table-bordered border-2 table-striped ">

        <thead>
            <tr>
                <th>Name</th>
                <th>Controllers</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($cities as $city)
                <tr>
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


@endsection
