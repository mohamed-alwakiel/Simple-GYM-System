@extends('layouts.master')
@section('title', "View  Purchase Details")

@section('content')
<div class="container p-5">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Purchase Info</h3>

            <div class="card-tools row">
                <!-- This will cause the card to maximize when clicked -->
                <div class="col-md-4">
                    <button type="button" class="btn btn-info btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text text-secondary">Client Name : <span class="text-light font-weight-bold">{{ $package->name }}</span> </p>
            <p class="card-text text-secondary">Client Email : <span class="text-light font-weight-bold">{{$package->price}}</span> </p>
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
                swal("Cancelled", "Your Package is safe :)", "error");
            }
        });




    });
</script>
@stop

@stop