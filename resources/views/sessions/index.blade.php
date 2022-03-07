@extends('layouts.master')

@section('title', 'Sessions')


@section('content')
<div class="d-flex justify-content-center mb-3">
    <a href="{{ route('sessions.create') }}" class="btn btn-success ">Create session</a>
</div>
<div class="col-md-12 px-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Sessions</h3>
        </div>
        <div class="card-body">
            <table id="table" class="table text-center ">
                <thead>
                    <tr class="bg-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Day</th>
                        <th scope="col">Coach</th>
                        <th scope="col">started_at</th>
                        <th scope="col">finished_at </th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                    <tr class="bg-dark">
                        <th scope="row">{{ $session->id }}</th>
                        <td>{{ $session->name }}</td>
                        <td>{{ $session->day}}</td>
                        <td>
                            <ul style="list-style: none;" class="list-group list-group-flush">
                                @foreach($session->coaches as $coach)
                                <li class="list-group-item">{{ $coach->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $session->started_at }}</td>
                        <td>{{ $session->finished_at }}</td>

                        <!-- {{-- <td><a href="{{ route('sessions.show', ['id' => $session->id]) }}" class="btn btn-info">View</a></td> --}} -->
                        <td><a href="{{ route('sessions.edit', ['id' => $session->id]) }}" class="btn btn-success">Edit</a></td>

                        <td>
                            <form method="POST" action="{{ route('sessions.destroy', ['id' => $session->id]) }}">
                                @CSRF

                                @method('delete')
                                <input class='btn btn-danger' type="submit" onclick=" return confirm('are you sure ?')" value="Delete">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@endsection