@extends('layouts.master')

@section('title','Gyms')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="container">
            <a href="{{route('gyms.create')}}" class="btn btn-info btn-lg mt-5">Add New Gym </a>
            <div class="row">
                <div class="col-10 mt-5">
                    <table class="table table-hover text-center ">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Cover Image</th>
                            <th scope="col">City Name</th>
                            <th colspan="2" scope="col" >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gyms as $gym)
                            <tr>
                                <td scope="row">{{$gym->name}}</td>
                                <td scope="row"><img src="{{url('imgs/gym/'.$gym->cover_img)}} " width="80" height="80" alt=""/></td>
                                <td scope="row">{{$gym->city_id}}</td>
                                <td>

                                    <a  href="{{route('gyms.edit',$gym->id) }}" class="btn btn-primary  btn-sm">Edit</a>
                                </td>

                                <td>

                                    <form action="{{route('gyms.destroy', $gym->id)}}" method="post">
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
