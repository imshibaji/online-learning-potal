<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | Larnr Education</title>
    {{-- Theame Color --}}
    <meta name="theme-color" content="#3490dc">
    {{-- <link rel="icon" href="{{ url('/') }}/imgs/app-icon-114.png" type="image/png" sizes="16x16"> --}}
    <link rel="icon" href="/favicon.ico" sizes="16x16 32x32" type="image/ico">
    {{-- <link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.min.css">
    <link href="{{ url('/') }}/css/style.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/app.css" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-P440VPMBYV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-P440VPMBYV');
    </script>
    @yield('headers')

</head>
<body class="bg-light">

@include('layouts.common.header')
<div class="contents" style="padding-top: 50px">
    @yield('content')
</div>

@yield('footers')
<script src="{{url('/')}}/js/app.js"></script>
<script src="{{url('/')}}/js/script.js"></script>
@yield('scripts')
@captcha
</body>
</html>
