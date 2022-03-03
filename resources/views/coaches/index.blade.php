@extends('layouts.master')

@section('title')
    Coaches
@endsection

@section('content')
    <div class="w-50 mx-auto pt-3 d-flex justify-content-end">
        <a href="{{ route('coaches.create') }}" class="btn btn-success my-3">Add New Coach</a>
    </div>

    <table class="w-50 mx-auto text-center table-bordered border-2 table-striped ">


        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($coaches as $coach)
                <tr>
                    <th scope="row">{{ $coach->id }}</th>
                    <td>{{ $coach->name }}</td>

                    {{-- <td><a href="{{ route('coaches.show', ['id' => $coach->id]) }}" class="btn btn-info">View</a></td> --}}
                    <td class="d-flex justify-content-around py-2">
                        <a href="{{ route('coaches.edit', ['id' => $coach->id]) }}" class="btn btn-success">
                            Edite
                        </a>

                        <form method="POST" action="{{ route('coaches.destroy', ['id' => $coach->id]) }}">
                            @CSRF

                            @method('delete')
                            <input class='btn btn-danger' type="submit" onclick=" return confirm('are you sure ?')"
                                value="Delete">
                        </form>

                        </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
