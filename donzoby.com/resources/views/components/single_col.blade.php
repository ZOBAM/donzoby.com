@props(['title' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/main.scss', 'resources/sass/user-area.scss'])
</head>

<body class="font-sans antialiased">
    <div class='tw-py-2 tw-px-4 tw-flex tw-justify-between'>
        <h1 style="font-size: 0.9em" class="float-left">Tech Tutorials for The Elects</h1>
        <div class="">
            @guest
                <a href="{{ url('register') }}" class="float-right align-middle">Register</a>
                <a class="float-right" href="{{ url('login') }}">Login</a>
            @else
                <a href = "{{ url('user-area') }}" style="text-transform: uppercase;" class="float-right">
                    {{ Auth::user()->name }}</a>
                <a class="float-right" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endguest
        </div>
    </div>
    @include('layouts.navigation')

    <!-- Page Content -->
    <main class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="single-col">
                    <!-- <h1>Welcome to DTech where we do tech with conscience!</h1> -->
                    {{ $slot }}

                </div>
            </div>
        </div>
        <x-footer />


    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/b379d389cf.js" crossorigin="anonymous"></script>
</body>

</html>
