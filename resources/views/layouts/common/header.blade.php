 <!-- Navbar Start -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-mycolor fixed-top">
    <div class="container-fluid">
    <a class="navbar-brand" href="https://larnr.com">
        <img src="{{ url('/') }}/images/logo-dark.png" class="logo-img">
        {{-- {{ config('app.name') }} --}}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @guest
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="/">Main</a>
                </li>
                <li class="nav-item {{ Request::is('courses') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="https://www.larnr.com/courses">Courses</a>
                </li>
            @else
                <li class="nav-item {{ Request::is('user/courses') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="http://larnr.com/courses">Articles</a>
                </li>
                <li class="nav-item {{ Request::is('user/courses') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="http://larnr.com/courses">Courses</a>
                </li>
            @endguest
        </ul>

        <ul class="navbar-nav mr-end">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('signup'))
                    <li class="nav-item {{ Request::is('signup') ? 'active' : '' }}">
                        <a class="nav-link hover-nav" href="{{ route('signup') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                @utype('admin')
                    <li class="nav-item">
                        <a class="nav-link hover-nav" href="{{ route('admin') }}">Admin Dashboard</a>
                    </li>
                @endutype
                @utype('stuff')
                    <li class="nav-item">
                        <a class="nav-link hover-nav" href="{{ route('admin') }}">Admin Dashboard</a>
                    </li>
                @endutype
                <li class="nav-item {{ Request::is('user/my-courses') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="{{route('userMyCourses')}}">My Courses</a>
                </li>
                @utype('admin')
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-pill badge-danger" style="float:right;margin-bottom:-18px;margin-right:-6px;">4</span>
                        <i class="fa fa-bell fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <div class="dropdown-item">Notifications</div>
                        <div class="dropdown-divider"></div>
                        @for($i=0; $i<4; $i++)
                            <a class="dropdown-item" href="#">
                                <div class="p-2">
                                    <h6 class="p-0 m-0">Notification Title</h6>
                                    <small>This is test notification. This is test notification.</small>
                                </div>
                            </a>
                        @endfor
                    </div>
                </li>
                @endutype
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link hover-nav dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{-- <img src="{{ url('/') }}/imgs/shibaji.png" class="img-thumbnail-icon"> --}}
                        {{ Auth::user()->fname }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @utype('admin')
                        <a class="dropdown-item"" href="{{ route('teacher.home') }}">
                            Teacher Room
                        </a>
                        @endutype
                        <a class="dropdown-item" href="{{ route('transactions') }}">
                            {{ __('Billing') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            @captchaHTML
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
    </div>
</nav>
<!-- Navbar End -->
