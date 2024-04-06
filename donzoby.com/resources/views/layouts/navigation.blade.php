<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Donzoby</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="ms-auto navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Graphics
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('graphics/coreldraw') }}">CorelDraw</a></li>
                        <li><a class="dropdown-item" href="{{ url('graphics/photoshop') }}">Photoshop</a></li>
                        <li><a class="dropdown-item" href="{{ url('graphics/gimp') }}">Gimp</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('graphics/special-series') }}">Special Series</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('graphics/how-tos') }}">How Tos</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Front End
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/front-end/html') }}">HTML</a></li>
                        <li><a class="dropdown-item" href="{{ url('/front-end/css') }}">CSS</a></li>
                        <li><a class="dropdown-item" href="{{ url('/front-end/javascript') }}">JavaScript</a></li>
                        <li><a class="dropdown-item" href="{{ url('/front-end/vue') }}">Vue Js</a></li>
                        <li><a class="dropdown-item" href="{{ url('/front-end/nuxt') }}">Nuxt</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('front-end/special-series') }}">Special
                                Series</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('front-end/how-tos') }}">How Tos</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Back End
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/back-end/php') }}">PHP</a></li>
                        <li><a class="dropdown-item" href="{{ url('/back-end/sql') }}">SQL</a></li>
                        <li><a class="dropdown-item" href="{{ url('/back-end/laravel') }}">Laravel</a></li>
                        <li><a class="dropdown-item" href="{{ url('/back-end/mysql') }}">MySql</a></li>
                        <li><a class="dropdown-item" href="{{ url('/back-end/node') }}">Node Js</a></li>
                        <li><a class="dropdown-item" href="{{ url('/back-end/express') }}">Express Js</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('back-end/special-series') }}">Special
                                Series</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('back-end/how-tos') }}">How Tos</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Mobile Dev
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/mobile-app-dev/flutter') }}">Flutter</a></li>
                        <li><a class="dropdown-item" href="{{ url('/mobile-app-dev/android-kotlin') }}">Android
                                Kotlin</a></li>
                        <li><a class="dropdown-item" href="{{ url('/back-end/sql') }}">SQL</a></li>
                        <li><a class="dropdown-item" href="{{ url('/mobile-app-dev/android-java') }}">Android
                                Java</a></li>
                        <li><a class="dropdown-item" href="{{ url('/mobile-app-dev/ios-swift') }}">iOS Swift</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('mobile-app-dev/special-series') }}">Special
                                Series</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('mobile-app-dev/how-tos') }}">How Tos</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Windows Dev
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/windows-dev/c-sharp') }}">C# (C Sharp)</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('/windows-dev/java') }}">Java</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        MS Office
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/ms-office/ms-word') }}">MS Word</a></li>
                        <li><a class="dropdown-item" href="{{ url('/ms-office/ms-powerpoint') }}">MS
                                Powerpoint</a></li>
                        <li><a class="dropdown-item" href="{{ url('/ms-office/ms-excel') }}">Ms Excel</a></li>
                        <li><a class="dropdown-item" href="{{ url('/ms-office/ms-access') }}">MS Access</a></li>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ url('ms-office/special-series') }}">Special
                        Series</a>
                </li>
                <li><a class="dropdown-item" href="{{ url('ms-office/how-tos') }}">How Tos</a>
                </li>
            </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Office Operations
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('/office-operations/paper-work') }}">Paper Work</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('/office-operations/machine-operations') }}">Machine
                            Operations</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ url('office-operations/special-series') }}">Special
                            Series</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('office-operations/how-tos') }}">How Tos</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Internet Use
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('/internet-usage/browsers') }}">Browsers</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('/internet-usage/online-services') }}">Online
                            Services</a></li>
                    <li>
                    <li><a class="dropdown-item" href="{{ url('/internet-usage/miscellaneous') }}">Miscellaneous</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ url('internet-usage/special-series') }}">Special
                            Series</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('internet-usage/how-tos') }}">How Tos</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Mobile Usage
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('/mobile-usage/android-phones') }}">Android
                            Phones</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('/mobile-usage/iphones') }}">iPhones</a></li>
                    <li>
                    <li><a class="dropdown-item" href="{{ url('/mobile-usage/service-providers') }}">Service
                            Providers</a></li>
                    <li>
                    <li><a class="dropdown-item" href="{{ url('/mobile-usage/hardware') }}">Hardware</a></li>
                    <li>
                    <li><a class="dropdown-item" href="{{ url('/mobile-usage/apps') }}">Apps</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ url('mobile-usage/special-series') }}">Special
                            Series</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('mobile-usage/how-tos') }}">How Tos</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li> --}}
            </ul>
        </div>
    </div>
</nav>
