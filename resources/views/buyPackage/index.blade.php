@extends('layouts.master')

@section('title')
Buy Package
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="w-75 mx-auto pt-3 d-flex justify-content-end">
        <a href="{{ route('buyPackage.create') }}" class="btn btn-success my-3">Buy Package</a>
    </div>

    <table class="w-75 mx-auto text-center table-bordered border-2 table-striped ">
        <thead>

            <tr>
            <th class="col-2">package name</th>
                <th class="col-2">price</th>
                <th class="col-2">Number Of Sessions</th>
                <th class="col-2">created_at</th>
                <th class="col-2">trainee</th>
                <th class="col-2">Gym name</th>
                <th class="col-2">Actions</th>
            </tr>
        </thead>
        @foreach ($boughtPackageCollection as $package)
            <tr>
            <td>{{$package->package ? $package->package->name : 'not found'}}</td>
                <td>{{ $package->price }}</td>
                <td>{{ $package->number_of_sessions }}</td>
                <td>{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </td>
                <td>{{$package->user ? $package->user->name : 'not found'}}</td>
                <td>{{$package->gym ? $package->gym->name : 'not found'}}</td>              
                <td class="py-2">
                    <a href="{{ route('buyPackage.show', ['package' => $package->id]) }}" class="btn btn-info"><i
                            class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    </div>


    <!-- /.content-wrapper -->

@endsection
