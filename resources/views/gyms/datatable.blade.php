@extends('layouts.master')

@section('title', 'Gyms')


@section('content')


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <center> <a href='{{route('gyms.create')}}' style="margin-top: 10px;" class="btn btn-success">Create Gym</a></center>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table text-center">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Cover Image</th>
                            <th class="text-center">City Name</th>
                            <th class="text-center">Created At</th>
                           <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletepopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Gym</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <div>
                        <div id="csrf_value"  hidden >@csrf</div>
                        {{--@method('DELETE')--}}
                        <button type="button" row_delete="" id="delete_item"  class="btn btn-danger" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

@endsection

@section('script')
<script>
    // let $  = require( 'jquery' );
    // var dt = require( 'datatables.net' )();
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            'paging'      : true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,

            "bLengthChange": true,
            'autoWidth'   : true,
            ajax: '{!! route('get.gym') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },

                { data: 'cover', name: 'cover' },
                { data: 'city', name: 'city' },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'}
            ],
            success:function(data){
                console.log(data);
            },

        });
        $(document).on('click','#delete_toggle',function () {
            var delete_id = $(this).attr('row_id');
            $('#delete_item').attr('row_delete',delete_id);
        });
        $(document).on('click','#delete_item',function () {
            var gymId = $(this).attr('row_delete');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/gyms/'+gymId,
                type: 'DELETE',
                success: function () {
                    alert("Gym has been deleted successfully");
                    var table = $('#table').DataTable();
                    table.ajax.reload();
                },
                error: function (response) {
                    alert(' error');
                    console.log(response);
                }
            });
        });
    });
</script>


@endsection
