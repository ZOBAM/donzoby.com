<div class='tw-py-2 tw-px-4 tw-flex tw-justify-between'>
    <h1 style="font-size: 0.9em" class="float-left">Tech Tutorials for The Elects</h1>
    <div class="">
        @guest
            <a href="{{ url('register') }}" class="float-right align-middle">Register</a>
            <a class="float-right align-middle" href="{{ url('login') }}">Login</a>
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
