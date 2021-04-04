<nav class="navbar navbar-expand-md navbar-dark bg-blue fixed-top">
    <div class="d-flex flex-grow-1">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ url('/') }}/images/logo-dark.png" class="logo-img">
            {{-- Larnr Education --}}
        </a>
        <form action="/search" class="mr-2 my-auto w-100 d-none d-sm-inline-block order-1">
            <div class="input-group">
                <input type="text" name="q" class="form-control border border-right-0" placeholder="Search...">
                <span class="input-group-append">
                    <button class="btn btn-outline-light border border-left-0" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    </div>
    <button class="navbar-toggler order-0" type="button" data-toggle="collapse" data-target="#navbar7">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse flex-shrink-1 flex-grow-0 order-last" id="navbar7">
        <ul class="navbar-nav">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <li class="nav-item">
                    <a class="nav-link hover-nav" href="{{ route('login')}}">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link hover-nav" href="{{ route('register') }}">Free Registration</a>
                </li>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link hover-nav" href="{{ route('user') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link hover-nav dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{-- <img src="{{ url('/') }}/imgs/shibaji.png" class="img-thumbnail-icon"> --}}
                        {{ Auth::user()->fname }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        <!-- Authentication Links -->
        </ul>
    </div>
</nav>

