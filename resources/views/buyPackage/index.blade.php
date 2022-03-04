@extends('layouts.master')

@section('title')
Buy Package
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- general form elements -->

<div class="card card-primary w-50 my-5 mx-auto">

    <div class="card-header bg-success">
        <h3 class="card-title">Buy Package</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body ">
        <form class="w-50 mx-auto" action="#" method="post">

            <!-- Select City -->
            @role('admin')
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select class="form-control" name="city" id="citySelector">
                    <option value="0" disabled selected>Choose City</option>

                    @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach

                </select>
            </div>
            @endrole

            {{--
            <!-- @if(auth()->user()->hasanyrole('gymManager|cityManager|client'))
            //
            @endif -->
            --}}
            
            <!-- Select Gym -->
            @hasanyrole('admin|cityManager')
            <div class="mb-3">
                <label for="gym" class="form-label">gym</label>
                <select class="form-control" name="gym" id="gymSelector">

                </select>
            </div>
            @endhasanyrole


            <!-- Select Package -->
            <div class="mb-3">
                <label>Select Package</label>
                <select id="selectedPackage" name="selectedPackage" class="form-control">
                    <option value="0" disabled selected>Choose Package</option>
                    @foreach ($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select User -->
            @hasanyrole('admin|cityManager|gymManager')
            <div class="form-group">
                <label>Select User</label>
                <select id="selectedUser" name="selectedUser" class="form-control">
                    <option value="0" disabled selected>Choose User</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            @endhasanyrole

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn bg-success py-2 px-4">Buy</button>
            </div>

        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- /.content-wrapper -->
<script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function() {
        $('#citySelector').on('change', function() {
            let id = $(this).val();
            $('#gymSelector').empty();
            $('#gymSelector').append('<option value="0" disabled selected>Processing</option>');
            $.ajax({

                url: '/getGymsBelongsToCity/' + id,

                type: "GET",


                success: function(response) {
                    var response = JSON.parse(response);

                    $('#gymSelector').empty();
                    $('#gymSelector').append('<option value="0" disabled selected>Select Sub Category</option>');
                    response.forEach(element => {
                        $('#gymSelector').append(`<option value="${element['id']}">${element['name']}</option>`);
                    });
                }

            });
        });
    });
</script>
@endsection