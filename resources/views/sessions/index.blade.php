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

        </tbody>
    </table>
    {{ $sessions->links() }}
    </div>
    <!-- /.content-wrapper -->
@endsection
