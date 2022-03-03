@extends('layouts.master')

@section('title')
    Sessions
@endsection

@section('content')
    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
        <a href="{{ route('sessions.create') }}" class="btn btn-success my-3">Add New session</a>
    </div>

    <table class="w-75 mx-auto text-center table-bordered border-2 table-striped ">

        <thead>
            <tr>
                <th scope="col">Session number</th>
                <th scope="col">Name</th>
                <th scope="col">Day</th>
                <th scope="col">Coach</th>

                <th scope="col">started_at</th>
                <th scope="col">finished_at </th>

                <th>Controllers</th>
            </tr>
        </thead>
        <tbody>
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
                        <a href="{{ route('sessions.edit', ['id' => $session->id]) }}" class="btn btn-success">Edite</a>

                        <form method="POST" action="{{ route('sessions.destroy', ['id' => $session->id]) }}">
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
    {{ $sessions->links() }}
    </div>
    <!-- /.content-wrapper -->
@endsection
