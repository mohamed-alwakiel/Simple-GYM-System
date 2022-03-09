@extends('layouts.master')

@section('title', 'Sessions')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
                <a href="{{ route('sessions.create') }}" class="btn btn-success my-3">Add New session</a>
            </div>
            <table id="table_id" class="display">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Day</th>
                    <th>Coach</th>
                    <th>Started_At</th>
                    <th>Finished_At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody style=" color: #0a0e14">
                @foreach ($sessions as $session)
                    <tr>
                        <th scope="row">{{ $session->id }}</th>
                        <td>{{ $session->name }}</td>
                        <td>{{ $session->day }}</td>
                        <td>
                            <ul>
                                @foreach ($session->coaches as $coach)
                                    <li>{{ $coach->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $session->started_at }}</td>
                        <td>{{ $session->finished_at }}</td>

                        {{-- <td><a href="{{ route('sessions.show', ['id' => $session->id]) }}" class="btn btn-info">View</a></td> --}}
                        <td class="d-flex justify-content-around py-2">
                            @if ( count($session->attendances)==0)
                            <a href="{{ route('sessions.edit', ['id' => $session->id]) }}" class="btn btn-success">Edite</a>

                            <form method="POST" action="{{ route('sessions.destroy', ['id' => $session->id]) }}">
                                @CSRF

                                @method('delete')
                                <input class='btn btn-danger' type="submit" onclick=" return confirm('are you sure ?')"
                                       value="Delete">
                            </form>
                            @endif
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
