<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$title ?? 'Welcome Teacher, Build your students community'}}</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/teacher.css') }}"> --}}
        {{-- <link rel="icon" href="{{ url('/') }}/imgs/app-icon-114.png" type="image/png" sizes="16x16"> --}}
        <link rel="icon" href="/favicon.ico" sizes="16x16 32x32" type="image/ico">
        {{-- <link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.min.css">
        {{-- Laravel Mix - CSS File --}}
        @yield('headers')
        <link rel="stylesheet" href="{{ asset('css/larnr.css') }}">
        <link href="{{ url('/') }}/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('/') }}/css/prism_coy.css">
        @yield('styles')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-P440VPMBYV"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-P440VPMBYV');
        </script>
    </head>
    <body>
        @include('teacher::layouts.header')
        <div style="margin-top:60px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    @include('teacher::layouts.sidebar')
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/teacher.js') }}"></script> --}}
        @yield('footers')
        <script src="{{ asset('js/larnr.js') }}"></script>
        <script src="{{url('/')}}/js/jquery.min.js"></script>
        <script src="{{url('/')}}/js/script.js"></script>
        <script src="{{url('/')}}/vendors/ckeditor/ckeditor.js"></script>
        <script src="{{url('/')}}/js/prism_patched.min.js"></script>
        @yield('scripts')
    </body>
</html>
