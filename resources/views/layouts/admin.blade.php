<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Shibaji Debnath'}} | Technology Learning Center</title>
    <link rel="icon" href="{{ url('/') }}/imgs/app-icon-114.png" type="image/png" sizes="16x16">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.min.css">
    <link href="{{ url('/') }}/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/css/prism_patched.min.css">
    <link href="{{ url('/') }}/css/app.css" rel="stylesheet">
@section('headers')
@show
</head>

<body class="bg-dark">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-mycolor fixed-top">
        <div class="container">
        <a class="navbar-brand" href="{{ url('/admin') }}">
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
                    <li class="nav-item active">
                        <a class="nav-link hover-nav" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                @else
                    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                        <a class="nav-link hover-nav" href="{{route('admin')}}">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/learn/course/list') ? 'active' : '' }}">
                        <a class="nav-link hover-nav" href="{{route('admincourselist')}}">Courses</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link hover-nav" href="#">Jobs Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-nav" href="#">Notifications</a>
                    </li> --}}
                    <li class="nav-item {{ Request::is('admin/user/list') ? 'active' : '' }}">
                        <a class="nav-link hover-nav" href="{{route('adminuserlist')}}">Users</a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/video') ? 'active' : '' }}">
                        <a class="nav-link hover-nav" href="{{route('video.index')}}">Videos</a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/notify/list') ? 'active' : '' }}">
                        <a class="nav-link hover-nav" href="{{route('adminnotifylist')}}">Notifitions</a>
                    </li>
                    @utype('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link hover-nav dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          All Learnings
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('admincatagorylist')}}">Catagories</a>
                            <a class="dropdown-item" href="{{route('admincourselist')}}">Courses</a>
                            <a class="dropdown-item" href="{{route('admintopiclist')}}">Topics</a>
                            <a class="dropdown-item" href="{{route('adminquestionlist')}}">Questions</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('admincommentlist')}}">Comments</a>
                        </div>
                    </li>
                    @endutype
                @endguest
            </ul>

            <ul class="navbar-nav mr-end">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link hover-nav" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link hover-nav" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link hover-nav" href="{{ route('user') }}">User Dashboard</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link hover-nav dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{-- <img src="{{ url('/') }}/imgs/shibaji.png" class="img-thumbnail-icon"> --}}
                            {{ Auth::user()->fname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin-profile') }}">
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
    <div class="contents page-height">
        @section('content')

        @show

          <!-- Copyright By -->
        <div class="container">
            <div class="row p-3 m-0">
                <div class="col-md">
                    <p class="text-light">SDLearn v1.0.0</p>
                </div>
                <div class="col-md text-center">
                    <p class="text-light">
                        &copy; Copyright By <a class="text-light" href="https://www.larnr.com">Larnr.com</a>.
                        {{ date('Y') }}
                    </p>
                </div>
                <div class="col-md text-right">
                    <p class="text-light">Developed By <a class="text-light" href="https://www.medust.com">Medust Technology Pvt. Ltd.</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- Copyright By -->

    </div>

@section('footers')
@show

{{-- <script src="{{url('/')}}/js/jquery.min.js"></script>
<script src="{{url('/')}}/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/vendors/ckeditor/ckeditor.js"></script> --}}

<script src="{{url('/')}}/js/app.js"></script>
<script src="{{url('/')}}/vendors/ckeditor/ckeditor.js"></script>
<script src="{{url('/')}}/js/prism_patched.min.js"></script>
<script src="{{url('/')}}/js/script.js"></script>
@section('scripts')
@show
@section('scripts2')
@show
</body>
</html>
