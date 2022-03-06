@extends('layouts.master')

@section('title', 'Revenue')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Purchased Packages overall your Cities</h3>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table text-center table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Client Name</th>
                                    <th class="text-center">Client email</th>
                                    <th class="text-center">Package Name</th>
                                    <th class="text-center">Paid Price</th>
                                    @role('admin|cityManager')
                                    <th class="text-center">Gym</th>
                                    @endrole
                                    @role('admin')
                                    <th class="text-center">City</th>
                                    @endrole
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Delete Product Modal -->
<div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Gym</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeleteForm" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@role('admin')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            serverSide: true,
            paging: true,
            pageLength: 8,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,
            bLengthChange: true,
            autoWidth: true,

            ajax: '{{ route("getRevenue") }}',
            columns: [{
                    data: 'Client Name',
                    name: 'Client Name'
                },
                {
                    data: 'Client Email',
                    name: 'Client Email'
                },
                {
                    data: 'Package Name',
                    name: 'Package Name'
                },
                {
                    data: 'Paid Price',
                    name: 'Paid Price'
                },
                {
                    data: 'Gym',
                    name: 'Gym'
                },
                {
                    data: 'City',
                    name: 'City'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ],

        });
        // Delete product Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function() {
            deleteID = $(this).data('id');

        })
        $('#SubmitDeleteForm').click(function(e) {
            e.preventDefault();

            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "revenue/" + id,
                method: 'DELETE',


                success: function() {

                    $('#table').DataTable().ajax.reload();
                    $('#DeleteProductModal').hide();
                },
                error: function(response) {
                    alert(' error');
                }
            });
        });
    });
</script>
@endrole

@role('cityManager')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            serverSide: true,
            paging: true,
            pageLength: 5,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,
            bLengthChange: true,
            autoWidth: true,

            ajax: '{{ route("getRevenue") }}',
            columns: [{
                    data: 'Client Name',
                    name: 'Client Name'
                },
                {
                    data: 'Client Email',
                    name: 'Client Email'
                },
                {
                    data: 'Package Name',
                    name: 'Package Name'
                },
                {
                    data: 'Paid Price',
                    name: 'Paid Price'
                },
                {
                    data: 'Gym',
                    name: 'Gym'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ],

        });
        // Delete product Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function() {
            deleteID = $(this).data('id');

        })
        $('#SubmitDeleteForm').click(function(e) {
            e.preventDefault();

            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "revenue/" + id,
                method: 'DELETE',


                success: function() {

                    $('#table').DataTable().ajax.reload();
                    $('#DeleteProductModal').hide();
                },
                error: function(response) {
                    alert(' error');
                }
            });
        });
    });
</script>
@endrole

@role('gymManager')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            serverSide: true,
            paging: true,
            pageLength: 8,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,
            bLengthChange: true,
            autoWidth: true,

            ajax: '{{ route("getRevenue") }}',
            columns: [{
                    data: 'Client Name',
                    name: 'Client Name'
                },
                {
                    data: 'Client Email',
                    name: 'Client Email'
                },
                {
                    data: 'Package Name',
                    name: 'Package Name'
                },
                {
                    data: 'Paid Price',
                    name: 'Paid Price'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ],

        });
        // Delete product Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function() {
            deleteID = $(this).data('id');

        })
        $('#SubmitDeleteForm').click(function(e) {
            e.preventDefault();

            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "revenue/" + id,
                method: 'DELETE',


                success: function() {

                    $('#table').DataTable().ajax.reload();
                    $('#DeleteProductModal').hide();
                },
                error: function(response) {
                    alert(' error');
                }
            });
        });
    });
</script>
@endrole

@endsection