<nav class="navbar navbar-expand-md navbar-dark bg-blue fixed-top">
    <a href="/" class="navbar-brand">
        <img src="{{ url('/') }}/images/logo-dark.png" alt="Larnr Education" class="logo-img">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar5">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbar5">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('articles') ? 'active' : '' }}">
                <a class="nav-link hover-nav" href="/articles">Articles</a>
            </li>
            {{-- <li class="nav-item {{ Request::is('allvideos') ? 'active' : '' }}">
                <a class="nav-link hover-nav" href="/allvideos">Videos</a>
            </li> --}}
            <li class="nav-item {{ Request::is('courses') ? 'active' : '' }}">
                <a class="nav-link hover-nav" href="/courses">Courses</a>
            </li>
        </ul>
        {{-- <form action="/search" class="mx-2 my-auto d-none d-sm-inline-block w-100">
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="t" class="custom-select" id="type">
                        <option value="all" selected>All</option>
                        <option value="video">Videos</option>
                        <option value="article">Articles</option>
                        <option value="course">Courses</option>
                    </select>
                </div>
                <input name="q" type="text" class="form-control border border-right-0" placeholder="Search...">
                <span class="input-group-append">
                    <button class="btn btn-outline-secondary border text-light border-left-0" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>--}}
        <ul class="navbar-nav mr-end">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link hover-nav" href="{{ route('login')}}">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link hover-nav" href="{{ route('register') }}">Register</a>
                </li>
            @else
                {{-- <li class="nav-item">
                    <a class="nav-link hover-nav" href="{{ route('user') }}">
                        <i class="fa fa-lg fa-user-circle" aria-hidden="true"></i>
                    </a>
                </li> --}}
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
                {{-- <li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="{{route('user')}}">Dashboard <span class="sr-only">(current)</span></a>
                </li> --}}
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
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle fa-lg"></i>
                        {{ Auth::user()->fname }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('transactions') }}">
                            {{ __('Billing') }}
                        </a>
                        <a class="dropdown-item"" href="{{ route('teacher.home') }}">
                            {{ __('Teacher Room') }}
                        </a>
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
