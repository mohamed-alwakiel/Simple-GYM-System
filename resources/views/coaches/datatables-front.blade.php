@extends('layouts.master')

@section('title', 'Coaches')

@section('content')
    <div class="">
        <div class="w-50 mx-auto pt-3 d-flex justify-content-end">
            <a href="{{ route('coaches.create') }}" class="btn btn-success my-3">Add New Coach</a>
        </div>
        <div class="">

            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody style=" color: #0a0e14">
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

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>

@endsection
