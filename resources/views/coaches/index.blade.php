@extends('layouts.master')

@section('title')
Coaches
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class='container dark:bg-gray-900'>
    <div class="text-center mt-5">
        <a href="{{ route('coaches.create') }}" class="btn btn-success ">Add Coach</a>

    </div>
    <table class="table">
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
                    <td><a href="{{ route('coaches.edit', ['id' => $coach->id]) }}" class="btn btn-success">Edite</a></td>

                    <td>

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
    {{-- {{ $coaches->links() }} --}}
</div>
<!-- /.content-wrapper --
@endsection