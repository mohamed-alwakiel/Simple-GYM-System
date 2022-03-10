@extends('layouts.master')
@section('title')
View "{{ $package->name }}" Package
@endsection
@section('content')
<div class="container p-5">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Package Info</h3>

            <div class="card-tools row">
                <!-- This will cause the card to maximize when clicked -->
                <div class="col-md-4">
                    <button type="button" class="btn btn-info btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
                <!-- This will cause the card to be Edited when clicked -->
                <div class="col-md-4">
                    <a class="btn btn-tool btn-info" href="{{ route('trainingPackages.edit', ['package' => $package->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                </div>
                <!-- This will cause the card to be removed when clicked -->
                <form class="col-md-4" action="{{ route('trainingPackages.destroy',$package->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-tool"><i class="fas fa-times"></i></button> -->
                    <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool" data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text text-secondary">Name : <span class="text-light font-weight-bold">{{ $package->name }}</span> </p>
            <p class="card-text text-secondary">Price : <span class="text-light font-weight-bold">{{$package->price /100 }} $</span> </p>
            <p class="card-text text-secondary">Number Of Sessions : <span class="text-light font-weight-bold">{{$package->number_of_sessions}}</span> </p>
            <p class="card-text text-secondary">Created at :<span class="text-light font-weight-bold">{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </span> </p>
        </div>
    </div>
</div>

@section('script')

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
                swal("Cancelled", "Your Package is safe :)", "info");
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
</script>
@enderror
@stop

@stop