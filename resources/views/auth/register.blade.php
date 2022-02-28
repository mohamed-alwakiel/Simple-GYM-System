@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Input addon -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-info ">
                <div class="card-header">
                    <h3 class="card-title mx-auto ">Join Us</h3>
                </div>
                <form id="quickForm" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="card-body">
                        <!-- username -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input name="name" type="text" class="form-control" placeholder="Name">
                        </div>

                        <!-- email -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- DOB -->
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input name="date_of_birth" type="text" class="form-control @error('date_of_birth') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask placeholder="Date of Birth">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="input-group my-4">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1" name="gender" value="male" checked>
                                <label for="customRadio1" class="custom-control-label mr-4">Male</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio2" name="gender" value="female">
                                <label for="customRadio2" class="custom-control-label mr-4">Female</label>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required autocomplete="new-password">
                        </div>


                        <!-- --------------------------- UNCOMMENT & EDIT ACCORDING TO DATABASE TABLES --------------------------- -->
                        <!-- Select City -->
                        {{--
                        <!-- <div class="input-group mb-3">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <select class="form-control" name="city" id="city">
                                <option hidden>Choose City</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                        </select>
                        </div>
                        <div class="mb-3">
                        <label for="branch" class="form-label">Branch</label>
                        <select class="form-control" name="branch" id="branch"></select>
                        </div>
                        </div> -->
                        --}}
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary font-weight-bold mt-3">
                                {{ __('Register') }}
                            </button>
                            <div class="mt-3">
                                <label>Have Account ? <a class="text-info" href="{{ route('login') }}">Login</a></label>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- --------------------------- UNCOMMENT THIS SCRIPT AFTER UNCOMMENTING CITY & GYM DROPDOWN MENUS --------------------------- -->
{{--
<!-- 
<script>
    $(document).ready(function() {
        $('#city').on('change', function() {
            var cityID = $(this).val();
            if (cityID) {
                $.ajax({
                    url: '/getbranch/' + cityID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
},
dataType: "json",
success: function(data) {
if (data) {
$('#branch').empty();
$('#branch').append('<option hidden>Choose branch</option>');
$.each(data, function(key, branch) {
$('select[name="branch"]').append('<option value="' + key + '">' + branch.name + '</option>');
});
} else {
$('#branch').empty();
}
}
});
} else {
$('#branch').empty();
}
});
});
</script> -->
--}}

@endsection