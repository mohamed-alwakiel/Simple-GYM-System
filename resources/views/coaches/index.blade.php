@extends('layouts.master')

@section('title')
    Coaches
@endsection

@section('content')

<div class="card ">
    <h5 class="card-header">Coaches</h5>


    <div class="w-50  pt-3 d-flex card-header">
        <a href="{{ route('coaches.create') }}" class="btn btn-success my-3">Add New Coach</a>
    </div>
    <div class="card-body">
    <table id="table" class="table text-center ">


        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">Gym name</th>

                <th>Edit</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($coaches as $coach)
                <tr>
                    <th scope="row">{{ $coach->id }}</th>
                    <td>{{ $coach->name }}</td>
                    <td>{{ $coach->gym ? $coach->gym->name : 'Not Found !' }}</td>



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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });

</script>
@endsection
