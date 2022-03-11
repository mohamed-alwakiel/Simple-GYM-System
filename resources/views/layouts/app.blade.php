<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome to Gym Club</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-image: url("{{ asset('dist/img/homeBG.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .card {
            background: rgb(0, 0, 0, 0.5);
            box-shadow: #17a2b870 0px 0px 4px 1px;
        }

        label {
            color: #ffffff80;
        }

        .form-control {
            background: #ffffff1f;
        }

        .form-control:focus{
            background: #ffffff00;
        }

        .custom-control {
            padding-left: .6rem;
        }
    </style>
</head>

<body>
    <div id="app">
        
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="150" width="150">
        </div>

        <main class="py-5">
            @yield('content')
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </div>
</body>

</html>