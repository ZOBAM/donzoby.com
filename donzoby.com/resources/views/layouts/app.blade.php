<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" content="{{ str_replace('https', 'http', $pageImage) }}" />
    <meta property="og:image:url" content="{{ str_replace('https', 'http', $pageImage) }}" />

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('css/line-number.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <!-- Scripts -->
    {{-- <link href="{{ asset('build/assets/app-DcSBx-Q1.css') }}" rel="stylesheet"> --}}
    {{-- <script src="{{ asset('build/assets/app-mqEmiGqA.js') }}" defer></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/main.scss'])
    @if ($customStyle == 'single')
        @vite(['resources/sass/single.scss'])
        {{-- <link href="{{ asset('build/assets/single-O6A__Uph.css') }}" rel="stylesheet"> --}}
    @elseif($customStyle == 'home')
        @vite(['resources/sass/home.scss'])
        {{-- <link href="{{ asset('build/assets/home-DVey3HtV.css') }}" rel="stylesheet"> --}}
    @endif

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
                    {{ Auth::user()->first_name }}</a>
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
                <div x-data="showNav" class="left-nav col-12 col-sm-3 col-md-2">
                    <span x-show="isSmallScreen || showLatest" @click="toggleShowNav" class="sm:tw-hidden">
                        <i x-show="!showLatest" class="fa fa-bars" aria-hidden="true"></i>
                        <i x-show="showLatest" class="fa fa-times" aria-hidden="true"></i> All
                        Latest</span>
                    <section x-show="!isSmallScreen || showLatest" class=" ">
                        <x-left-nav :$posts :$listedSubjects />
                    </section>
                    <script>
                        document.addEventListener('alpine:init', () => {
                            Alpine.data('showNav', () => ({
                                showLatest: false,
                                hasCheckedWidth: false,
                                isSmallScreen: false,

                                async init() {
                                    window.addEventListener('resize', function() {
                                        // Call the function to check window size
                                        checkWindowSize(window.innerWidth);
                                    });

                                    checkWindowSize = (width) => {
                                        if (width > 640) {
                                            this.showLatest = true;
                                            this.isSmallScreen = false;
                                        } else {
                                            this.showLatest = false;
                                            this.isSmallScreen = true;
                                        }
                                    }
                                    if (!this.hasCheckedWidth) {
                                        checkWindowSize(window.innerWidth);
                                        this.hasCheckedWidth = true;
                                    }
                                },

                                // GETTERS

                                // METHODS
                                toggleShowNav() {
                                    this.showLatest = !this.showLatest;
                                },
                            }));
                        });
                    </script>
                </div>
                <div class="col-12 col-sm-9 col-md-10 col-lg-7 line-numbers" style="font-family: Figtree">
                    <!-- <h1>Welcome to DTech where we do tech with conscience!</h1> -->
                    {{ $slot }}

                </div>
                <div class="col-12 d-sm-none d-lg-block col-md-3 tw-pt-4">
                    <img src="{{ asset('images/dzb-tut-ad.png') }}" alt="possible error message to users">
                    <p class="tw-border tw-text-center tw-p-2 tw-border-dashed tw-border-stone-500">
                        Please notify us of
                        any error or
                        mistake. While we are
                        making efforts to be accurate and as concise as possible, we know that some errors can still
                        slip through uncaught.</p>
                </div>
            </div>
        </div>
        <x-footer />


    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/b379d389cf.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/prism.js') }}"></script>
</body>

</html>
