<!Doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131304679-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-131304679-1');
      </script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
@section('description')
        <meta name="description" content="Donzoby offers well written and easy to follow tutorials on computer and web technologies for Christians. We also offer ICT and computer training at very cheap prices. We do tech with conscience.">
@show
        <link rel="shortcut icon"      type="image/png"       href="{{asset('public/images/favicon.png')}}">
@include('layouts.master-links')

@yield('links')
        <title>@yield('title')</title>

    </head>
  <body>
    <div id="wrapper">
      <div class='container-fluid' id='display-image'>
        <div class='row'>
@section('displayImage')
          <div class='col-sm-4'>
            <!--display image-->
            <!-- <img src="{{URL('public/images/donzoby-logo-wtbg2.png')}}"  class="img-responsive" alt="sliding display image"/> -->
          </div>
          <div class='col-sm-8'>
                <h1 style="font-size: 0.9em" class="float-left">Tech Tutorials for The Elects</h1>
                @guest
                <a href="{{ url('register') }}" class="float-right align-middle">Register</a> 
                <a class="float-right" href="{{ url('login') }}">Login</a>
                @else
                <a href = "{{ url('member') }}" style="text-transform: uppercase;" class="float-right"> {{ Auth::user()->name }}</a>
                <a class="float-right" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>  
              @endguest
          </div>
                
@show
        </div>
      </div>
          
         
@section('navBar')

  <nav class="navbar navbar-expand-sm navbar-light justify-content-center sticky-top" id="navBar">
    <!-- Brand <nav class="navbar navbar-expand-md bg-dark ">-->
    <div class="mx-auto d-sm-flex d-block flex-sm">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{URL('public/images/favicon.png')}}" class="img-responsive" alt="Solid Agents"/> DZB
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
        </li>
      </ul>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <!-- Links -->
        <ul class="navbar-nav">
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/graphics"  data-toggle="dropdown">Graphics</a> 
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('graphics/coreldraw') }}">CorelDraw</a>
              <a class="dropdown-item" href="{{ url('graphics/photoshop') }}">Photoshop</a>
              <a class="dropdown-item" href="{{ url('graphics/gimp') }}">Gimp</a>
            </div>
          </li>      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/web-design"  data-toggle="dropdown">Web Design</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/web-design/html') }}">HTML</a>
              <a class="dropdown-item" href="{{ url('/web-design/css') }}">CSS</a>
              <a class="dropdown-item" href="{{ url('/web-design/javascript') }}">JavaScript</a>
              <a class="dropdown-item" href="{{ url('/web-design/jquery') }}">JQuery</a>
              <a class="dropdown-item" href="{{ url('/web-design/bootstrap') }}">Bootstrap</a>
            </div>
          </li>      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/server-dev"  data-toggle="dropdown">Server Dev.</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/server-dev/php') }}">PHP</a>
              <a class="dropdown-item" href="{{ url('/server-dev/sql') }}">SQL</a>
              <a class="dropdown-item" href="{{ url('/server-dev/laravel') }}">Laravel</a>
              <a class="dropdown-item" href="{{ url('/server-dev/mysql') }}">MySql</a>
            </div>
          </li>      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/mobile-app-dev"  data-toggle="dropdown">Mobile App Dev.</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/mobile-app-dev/android-kotlin') }}">Android Kotlin</a>
              <a class="dropdown-item" href="{{ url('/mobile-app-dev/android-java') }}">Android Java</a>
              <!-- <a class="dropdown-item" href="{{ url('/mobile-app-dev/ios-swift') }}">iOS Swift</a> -->
            </div>
          </li>      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/windows-dev"  data-toggle="dropdown">Windows Dev.</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/windows-dev/c-sharp') }}">C# (C Sharp)</a>
              <a class="dropdown-item" href="{{ url('/windows-dev/java') }}">Java</a>
            </div>
          </li>      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/msoffice"  data-toggle="dropdown">MS Office</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/ms-office/ms-word') }}">MS Word</a>
              <a class="dropdown-item" href="{{ url('/ms-office/ms-powerpoint') }}">MS Powerpoint</a>
              <a class="dropdown-item" href="{{ url('/ms-office/ms-excel') }}">Ms Excel</a>
              <a class="dropdown-item" href="{{ url('/ms-office/ms-access') }}">MS Access</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/office-operations"  data-toggle="dropdown">Office Operations</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/office-operations/paper-work') }}">Paper Work</a>
              <a class="dropdown-item" href="{{ url('/office-operations/machine-operations') }}">Machine Operations</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/internet-usage"  data-toggle="dropdown">Internet Usage</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/internet-usage/browsers') }}">Browsers</a>
              <a class="dropdown-item" href="{{ url('/internet-usage/online-services') }}">Online Services</a>
              <a class="dropdown-item" href="{{ url('/internet-usage/miscellaneous') }}">Miscellaneous</a>
            </div>
          </li>      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/mobile-usage"  data-toggle="dropdown">Mobile Usage</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/mobile-usage/android-phones') }}">Android Phones</a>
              <a class="dropdown-item" href="{{ url('/mobile-usage/iphones') }}">iPhones</a>
              <a class="dropdown-item" href="{{ url('/mobile-usage/service-providers') }}">Service Providers</a>
              <a class="dropdown-item" href="{{ url('/mobile-usage/hardware') }}">Hardware</a>
              <a class="dropdown-item" href="{{ url('/mobile-usage/apps') }}">Apps</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav> 


          @show
          @yield('mainContent')

      <footer id="footer">
        @section('footer')
        <div class = 'container'>
          <div class='row'>
            <div class="col-sm-4">
                <h5>COMPANY INFO</h5> 
                <a href="/about-donzoby">About Us<br/></a> 
                <a href="/mission-&-vision">Mission & Vision<br/></a>
                Career<br/>
                <a href="/privacy-policy">Privacy Policy<br/></a>
                Terms of Use<br/>
            </div>
            <div class="col-sm-4">
              <h5>SOCIAL</h5> 
              <a href="https://www.facebook.com/donzoby"><i class="fab fa-facebook-square"></i> Facebook</a> <br/>
              <a href="#"><i class="fab fa-twitter-square"></i> Twitter</a>
            </div>
            <div class="col-sm-4">
              <h5>Learn</h5>
              Web Design<br/>
              Graphics<br/>
              Web Development<br/>
              Programming<br/>
            </div>
          </div>
        </div>              
        <div class = 'container-fluid'>    
          <div class="row" style="color:#EFF1EF;background-color: #3C3C3C">
            <div class='col-sm-12' style="color:#EFF1EF;background-color: #4D4D4D">CONTACT US:</div>
            <div class="col-sm-3">Email: info@donzoby.com</div>
            <div class="col-sm-6">Besides Bricks Estate, New Layout, Enugu State. </div>
            <div class="col-sm-3">Tel: 09057965147</div>
          </div>
        </div>
              @show
      </footer>

    </div><!-- end of wrapper-->
    @yield('bottomLinks')
  </body>
</html>
