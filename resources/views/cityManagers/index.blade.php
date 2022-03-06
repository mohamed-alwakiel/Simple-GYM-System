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

                                    <th>City Name</th>

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
                                            <img src="{{ url('imgs/CityMgr/' . $manager->profile_img) }} " width="50px"
                                                height="50px" alt="not found" />
                                        </th>

                                        <td>{{ $manager->city ? $manager->city->name : 'Not Found !' }}</td>

                                        <th class="d-flex justify-content-around py-2">
                                            <a href="{{ route('cityManagers.edit', $manager->id) }}"
                                                class="btn btn-primary">Update</a>

                                            <form action="{{ route('cityManagers.destroy', $manager->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" type="submit">
                                                    Delete
                                                </button>
                                            </form>

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
@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
