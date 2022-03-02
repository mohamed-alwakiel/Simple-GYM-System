@extends('layouts.master')

@section('title','cities')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="container">
        <a href="{{route('cities.create')}}" class="btn btn-info btn-lg mt-5">Add New City</a>
        <div class="row">
            <div class="col-10 mt-5">
                <table class="table table-hover text-center ">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th colspan="2" scope="col" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $city)
                    <tr>
                        <td scope="row">{{$city->name}}</td>
                        <td>

                                <a  href="{{route('cities.edit',$city->id) }}" class="btn btn-primary  btn-sm">Edit</a>
                        </td>
                        <td>

                            <form action="{{route('cities.destroy', $city->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are You Sure You Want To Delete?');"  id="btnDelete"
                                        class="btn btn-danger btn-sm" >
                                    Delete
                                </button>
                            </form>
                        </td>


                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
