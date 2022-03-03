

    <div class="text-center mt-5">
        <a href="{{ route('sessions.create') }}" class="btn btn-success ">Create session</a>

    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Session number</th>
                <th scope="col">Name</th>
                <th scope="col">Day</th>
                <th scope="col">Coach</th>

                <th scope="col">started_at</th>
                <th scope="col">finished_at </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <th scope="row">{{ $session->id }}</th>
                    <td>{{ $session->name }}</td>
                    <td>{{ $session->day}}</td>
                    <td>
                    <ul>
                    @foreach($session->coaches as $coach)
                       <li>{{ $coach->name }}</li>
                   @endforeach
                </ul>
            </td>
                    <td>{{ $session->started_at }}</td>
                    <td>{{ $session->finished_at }}</td>

                    {{-- <td><a href="{{ route('sessions.show', ['id' => $session->id]) }}" class="btn btn-info">View</a></td> --}}
                    <td><a href="{{ route('sessions.edit', ['id' => $session->id]) }}" class="btn btn-success">Edite</a></td>

                    <td>

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

<!-- /.content-wrapper -->
