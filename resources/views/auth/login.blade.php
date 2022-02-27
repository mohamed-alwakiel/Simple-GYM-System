@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-5">
                <!-- <div class="card-header">{{ __('Login') }}</div> -->
                <section class="content-header col-md-12">
                    <h1 class="text-center text-info">Login</h1>
                </section>
                <div class="card-body">
                    <form id="quickForm" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select id="roleSelect" name="role" class="form-control" onchange="ShowHideDiv()">
                                    <!-- <option class="text-center" value=""> -- Select Role -- </option> -->
                                    <option value="admin">Admin</option>
                                    <option value="gymManager">Gym Manager</option>
                                    <option value="cityManager">City Manager</option>
                                    <option value="client" selected>Client</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <div class="form-check">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label text-info" for="remember">{{ __('Remember Me') }}</label>
                                    @if (Route::has('password.request'))
                                    <a class="float-right text-info font-weight-bold" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info font-weight-bold">
                                {{ __('Login') }}
                            </button>
                            <div id="clientRoleValue" class="mt-3" style="display: block">
                                <label>No Account ? <a class="text-info" href="{{ route('register') }}">Register</a></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function ShowHideDiv() {
        var roleSelect = document.getElementById("roleSelect");
        var clientRoleValue = document.getElementById("clientRoleValue");
        clientRoleValue.style.display = roleSelect.value == "client" ? "block" : "none";
    }
</script>
@endsection