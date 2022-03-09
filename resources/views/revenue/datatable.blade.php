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
                                    <th>Delete</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boughtPackages as $boughtPackage)
                                <tr>
                                    <th>{{ $boughtPackage->user->name }}</th>
                                    <th>{{ $boughtPackage->user->email }}</th>
                                    <th>{{ $boughtPackage->name }}</th>
                                    <th>{{ $boughtPackage->price }}</th>
                                    @role('admin|cityManager')
                                    <th>{{ $boughtPackage->gym->name }}</th>
                                    @endrole
                                    @role('admin')
                                    <th>{{ $boughtPackage->city->name }}</th>
                                    <th>
                                        <button type="button" data-id="{{ $boughtPackage->id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>
                                    </th>
                                    @endrole
                                </tr>
                                @endforeach
                            </tbody>
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
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>


<script>
    $(document).ready(function() {
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

                    location.reload();

                    $('#DeleteProductModal').hide();
                },
                error: function(response) {
                    alert(' error');
                }
            });
        });
    });
</script>

@endsection