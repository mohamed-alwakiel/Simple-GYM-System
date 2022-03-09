@extends('layouts.master')

@section('title')
    Gym Managers
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mx-auto pt-3 d-flex justify-content-end">
            <div>
                <a href="{{ route('gymManagers.banned') }}" class="btn btn-dark my-3 mr-3">Show Banned Managers</a>
                <a href="{{ route('gymManagers.create') }}" class="btn btn-success my-3">Add New Manager</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Gym Managers</h3>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="table text-center ">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>National ID</th>
                                    <th>profile Img</th>

                                    <th>Gym Name</th>

                                    @role('admin')
                                        <th>City name</th>
                                    @endrole

                                    <th>Controllers</th>
                                </tr>
                            </thead>

                            <tbody>



                                @foreach ($gymManagers as $manager)
                                    <tr class="bg-dark">
                                        <th>{{ $manager->name }}</th>
                                        <th>{{ $manager->email }}</th>
                                        <th>{{ $manager->national_id }}</th>


                                        <th>
                                            <img src="{{ url('imgs/users/' . $manager->profile_img) }}" width="50px"
                                                height="50px" alt="not found" />
                                        </th>

                                        <td>{{ $manager->gym ? $manager->gym->name : 'Not Found !' }}</td>

                                        @role('admin')
                                            <td>{{ $manager->gym ? $manager->gym->city->name : 'Not Found !' }}</td>
                                        @endrole

                                        <th class="d-flex justify-content-around py-2">

                                            @if ($manager->isBanned())
                                                <a href="{{ route('gymManagers.unban', $manager->id) }}"
                                                    class="btn btn-light">UnBan</a>
                                            @elseif ($manager->isNotBanned())
                                                <a href="{{ route('gymManagers.ban', $manager->id) }}"
                                                    class="btn btn-dark">Ban</a>
                                            @endif
                                            <a href="{{ route('gymManagers.edit', $manager->id) }}"
                                                class="btn btn-primary">Update</a>

                                            <button type="button" data-id="{{ $manager->id }}" data-toggle="modal"
                                                data-target="#DeleteProductModal" class="btn btn-danger"
                                                id="getDeleteId">Delete</button>

                                            {{-- <form action="{{ route('gymManagers.destroy', $manager->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" type="submit">
                                                    Delete
                                                </button>
                                            </form> --}}

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
                    url: 'gymManagers/' + id,
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
