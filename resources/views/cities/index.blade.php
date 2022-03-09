@extends('layouts.master')

@section('title', 'cities')


@section('content')

    <div class="container w-50">
        <div class="mx-auto pt-3 d-flex justify-content-end">
            <div>
        <a href="{{ route('cities.create') }}" class="btn btn-success my-3">Add New City</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Cities</h3>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="table text-center ">



                            <thead>

                            <tr>
                                <th>Name</th>

                                <th>Controllers</th>
                            </tr>
                            </thead>


                            <tbody>

            @foreach ($cities as $city)
                <tr class="offerRow bg-dark">
                    <th>{{ $city->name }}</th>

                    <th class="d-flex justify-content-around py-2">
                        <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-primary">Update</a>
                        <a  data-toggle="modal" data-target="#DeleteProductModal"  city_id="{{$city -> id}}"  class="delete_btn btn btn-danger"> Delete </a>
{{--                        <form action="{{ route('cities.destroy', $city->id) }}" method="post">--}}
{{--                            @csrf--}}
{{--                            @method('delete')--}}
{{--                            <button class="btn btn-danger" type="submit">--}}
{{--                                Delete--}}
{{--                            </button>--}}
{{--                        </form>--}}

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
    <div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this City</h3>
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
        $(document).on('click', '#SubmitDeleteForm', function (e) {
            e.preventDefault();
            var city_id =  $('.delete_btn').attr('city_id');
            $.ajax({
                type: 'delete',
                url: "{{route('cities.destroy')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :city_id
                },
                success: function (data) {
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();
                }, error: function (reject) {
                }
            });
        });
    </script>
@endsection
