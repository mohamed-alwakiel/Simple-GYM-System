@extends('layouts.master')

@section('title')
    City Managers
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mx-auto pt-3 d-flex justify-content-end">
            <a href="{{ route('cityManagers.create') }}" class="btn btn-success my-3">Add New Manager</a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All City Managers</h3>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="table text-center ">

                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>National ID</th>
                                    <th>profile Img</th>

                                    <th>City</th>

                                    <th>Controllers</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($cityManagers as $manager)
                                    <tr class="bg-dark">
                                        <th>{{ $manager->name }}</th>
                                        <th>{{ $manager->email }}</th>
                                        <th>{{ $manager->national_id }}</th>

                                        <th>
                                            <img src="{{ url('imgs/users/' . $manager->profile_img) }} " width="50px"
                                                height="50px" alt="not found" />
                                        </th>

                                        <td>{{ $manager->city ? $manager->city->name : 'Not Found !' }}</td>

                                        <th class="d-flex justify-content-around py-2">
                                            <a href="{{ route('cityManagers.edit', $manager->id) }}"
                                                class="btn btn-primary">Update</a>

                                            <button type="button" data-id="{{ $manager->id }}" data-toggle="modal"
                                                data-target="#DeleteProductModal" class="btn btn-danger"
                                                id="getDeleteId">Delete</button>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Manager</h3>
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
            $('#table_id').DataTable();
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
                    url: 'cityManagers/' + id,
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
