@extends('layouts.master')

@section('title')
Training Packages
@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">

    @role('admin')
    <div class="d-flex justify-content-center mb-3">
        <a href="{{ route('trainingPackages.create') }}" class="btn btn-success">Add New Package</a>
    </div>
    @endrole
    <div class="col-md-12 px-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Packages</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table text-center ">
                    <thead>
                        <tr>
                            <th class="col-2">name</th>
                            <th class="col-2">price</th>
                            <th class="col-2">Number Of Sessions</th>
                            <th class="col-2">Created At</th>
                            <th class="col-2">Actions</th>
                        </tr>
                    </thead>
                    @foreach ($packageCollection as $package)
                    <tr>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->price / 100 }} $</td>
                        <td>{{ $package->number_of_sessions }}</td>
                        <td>{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </td>
                        <td class="d-flex justify-content-center">
                            <!-- Show Button -->
                            <a href="{{ route('trainingPackages.show', ['package' => $package->id]) }}" class="btn btn-md btn-info mr-2"><i class="fas fa-eye"></i></a>

                            <!-- Edit & Delete Buttons -->
                            @role('admin')
                            <a href="{{ route('trainingPackages.edit', ['package' => $package->id]) }}" class="btn btn-md btn-warning mr-2"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('trainingPackages.destroy', $package->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-md btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                            </form>
                            @endrole
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
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

    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete ?",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel", "Yes!"],
            confirmButtonColor: '#8CD4F5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel plz!",
        }).then((willDelete) => {
            if (willDelete) {
                try {
                    form.submit();
                }
                catch($e){
                    swal("Not deleted");
                }
            } else {
                swal("Cancelled", "Your Data is safe :)", "info");
            }
        });
    });

        @error('message')
            $(document).ready(function() {
            $(window).on('load', function() {
            swal({
            title: "You can't delete this package",
            text:"you have user bought this package",
            icon: "error",
            type: "error",
            confirmButtonColor: '#8CD4F5',
            confirmButtonText: 'Ok',

            });

            });
            });
        @enderror
    </script>

    <!-- /.content-wrapper -->

@stop
