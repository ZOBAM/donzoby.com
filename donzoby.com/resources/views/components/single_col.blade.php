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
    @if (App::environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/main.scss', 'resources/sass/user-area.scss'])
    @else
        {{-- <link href="{{ asset('build/assets/app-DcSBx-Q1.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/main-C6BhV7rv.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/user-area-DZhi3_zE.css') }}" rel="stylesheet">
    <script src="{{ asset('build/assets/app-mqEmiGqA.js') }}" defer></script>  --}}
    @endif
</head>

<body class="font-sans antialiased">
    @include('layouts.top-bar')
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
