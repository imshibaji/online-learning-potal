<nav class="navbar navbar-expand-lg navbar-dark bg-blue fixed-top">
    <a class="navbar-brand" href="{{url('/')}}">
        <img src="{{ url('/') }}/images/logo-dark.png" class="logo-img">
        {{-- Larnr Education --}}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link hover-nav" href="{{route('user')}}">Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link hover-nav" href="{{route('usercourses')}}">Courses</span></a>
        </li>
        {{-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> --}}
      </ul>
      <div class="d-block d-md-block">
        <ul class="navbar-nav mr-end">
           <!-- Authentication Links -->
            @guest
                <li class="nav-item active">
                    <a class="nav-link hover-nav" href="https://app.larnr.com">Free Registeration</a>
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
    </div>
  </nav>
