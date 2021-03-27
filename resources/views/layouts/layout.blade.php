<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'Shibaji Debnath'}} | Technology Learning Center</title>
    <link rel="icon" href="{{ url('/') }}/imgs/app-icon-114.png" type="image/png" sizes="16x16">
    {{-- <link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.min.css">
    {{--<link href="{{ url('/') }}/css/style.css" rel="stylesheet"> --}}
    <link href="{{ url('/') }}/css/app.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-mycolor fixed-top">
        <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('/') }}/imgs/app-icon-114.png" class="img-thumbnail-icon">
            {{ config('app.name') }}
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
                    <li class="nav-item active">
                        <a class="nav-link hover-nav" href="#">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-nav" href="#">Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-nav" href="#">All Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-nav" href="#">Professional Courses</a>
                    </li>
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
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
        </div>
    </nav>
    <!-- Navbar End -->
    <div class="contents bg-dark page-height">
        @section('content')

        @show

          <!-- Copyright By -->
        <div class="container">
            <div class="row p-3 m-0">
                <div class="col-md">
                    <p class="text-light">{{ env('APP_NAME') }} v{{ env('APP_VERSION') }}</p>
                </div>
                <div class="col-md text-center">
                    <p class="text-light">&copy; Copyright By <a class="text-light" href="https://www.shibajidebnath.com">Shibaji Debnath</a>. 
                        <br />{{ date('Y') }}</p>
                </div>
                <div class="col-md text-right">
                    <p class="text-light">Developed By <a class="text-light" href="https://www.medust.com">Medust Technology Pvt. Ltd.</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- Copyright By -->

    </div>

{{-- <script src="{{ url('/')}}/js/jquery.min.js"></script>
<script src="{{ url('/')}}/js/bootstrap.min.js"></script> --}}
<script src="{{url('/')}}/js/app.js"></script>
<script src="{{url('/')}}/js/script.js"></script>
</body>
</html>
