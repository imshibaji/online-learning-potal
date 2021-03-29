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
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P440VPMBYV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-P440VPMBYV');
</script>
@section('headers')
@show
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-mycolor fixed-top">
        <div class="container">
        <a class="navbar-brand" href="https://www.larnr.com">
            <img src="{{ url('/') }}/imgs/app-icon-114.png" class="img-thumbnail-icon">
            {{config('app.name')}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="/">Finder <span class="sr-only">(current)</span></a>
                </li>
                {{-- <li class="nav-item {{ Request::is('courses') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="/courses">Online Courses</a>
                </li> --}}
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="/about">About Me</a>
                </li>
                {{-- <li class="nav-item {{ Request::is('plans') ? 'active' : '' }}">
                    <a class="nav-link hover-nav" href="/plans">Price Plans</a>
                </li>

                 <li class="nav-item">
                    <a class="nav-link hover-nav" href="#">Professional Courses</a>
                </li> --}}
            </ul>
            <div class="d-block d-md-block">
                <ul class="navbar-nav mr-end">
                     <!-- Authentication Links -->
                        @guest
                            {{-- <li class="nav-item">
                                <a class="nav-link hover-nav" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link hover-nav" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                            <li class="nav-item">
                                <form method="POST" action="{{ route('signin') }}" class="form-inline my-2 my-lg-0">
                                    @csrf
                                    <input class="form-control mr-sm-2 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                    <input class="form-control mr-sm-2 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" value="{{ old('ppassword') }}" aria-label="Password">
                                    <button class="btn btn-light my-2 my-sm-0" type="submit">Login</button>
                                </form>
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
        </div>
    </nav>
    <!-- Navbar End -->

    @section('content')

    @show

<!-- Footer -->
    <div class="footer top-line">
        <div class="container">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="https://www.shibajidebnath.com/testimonials/">Testimonials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.shibajidebnath.com/payment/">Payments Options</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="https://www.shibajidebnath.com/terms-and-conditions/">Terms and Condition</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Become A Partner</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Footer -->
    <!-- Copyright -->
    <div class="copyright">
        <p class="text-center">
            &copy; Developed By Medust Technology Pvt. Ltd. {{ date('Y') }}.
        </p>
    </div>
    <!-- Copyright -->
    <!-- Add Call Btn -->
    <div class="d-block d-sm-none sticky-btn">
        <a class="btn btn-success btn-circle" href="tel:+918981009499">
            <i class="fa fa-phone"></i>
            Call Now
        </a>
    </div>

@section('footers')
@show
    <script src="{{url('/')}}/js/app.js"></script>
    <script src="{{url('/')}}/js/script.js"></script>

    @error('email')
        <div class="alert alert-danger alert-dismissible fade show"
        style="position: absolute; left:30%; top:10%; z-index:3000;"
        role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror
    <script>
        $('.alert').alert();
    </script>
@section('scripts')
@show
</body>
</html>
