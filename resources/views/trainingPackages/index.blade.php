@extends('layouts.master')

@section('title')
    Training Packages
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
        <a href="{{ route('trainingPackages.create') }}" class="btn btn-success my-3">Add New Package</a>
    </div>

    <table class="w-75 mx-auto text-center table-bordered border-2 table-striped ">
        <thead>

            <tr>
                <th class="col-2">id</th>
                <th class="col-2">name</th>
                <th class="col-2">price</th>
                <th class="col-2">Number Of Sessions</th>
                <th class="col-2">Created At</th>
                <th class="col-2">Actions</th>
            </tr>
        </thead>
        @foreach ($packageCollection as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->name }}</td>
                <td>{{ $package->price }}</td>
                <td>{{ $package->number_of_sessions }}</td>
                <td>{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </td>
                <td class="d-flex justify-content-around py-4">
                    <a class="col-md-4" href="{{ route('trainingPackages.show', ['package' => $package->id]) }}" class="btn btn-info"><i
                            class="fas fa-eye"></i>
                    </a>
                    <form class="col-md-4" action="{{ route('trainingPackages.destroy',$package->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-tool"><i class="fas fa-times"></i></button> -->
                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-tool" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this Package ?",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel", "Yes!"],
            confirmButtonColor: '#8CD4F5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel plz!",
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("Cancelled", "Your Package is safe :)", "error");
            }
        });




    });
</script>
    <!-- /.content-wrapper -->
 
@endsection
