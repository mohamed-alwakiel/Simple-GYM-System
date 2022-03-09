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
                        @if (auth()->user()->hasRole('gymManager'))
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        @endif
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
                        @if (auth()->user()->hasRole('gymManager'))


                        <td> @if ( count($session->attendances)==0)<a href="{{ route('sessions.edit', ['id' => $session->id]) }}" class="btn btn-md btn-success ">Edit</a></td>
                        @endif
                        <td> @if ( count($session->attendances)==0)
                            <form method="POST" action="{{ route('sessions.destroy', ['id' => $session->id]) }}">
                                @CSRF

                                @method('delete')
                                {{-- <input class='btn btn-danger' type="submit" onclick=" return confirm('are you sure ?')" value="Delete"> --}}
                                <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-md btn-danger  show-alert-delete-box  " data-toggle="tooltip" title='Delete'>Delete</button>
                            </form> @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });

    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
@endsection
