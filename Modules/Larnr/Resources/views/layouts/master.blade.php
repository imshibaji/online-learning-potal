<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$title ?? 'Best Software Tutorials videos'}} - Larnr Education</title>
        <!-- Primary Meta Tags -->
        <meta name="title" content="{{$title ?? 'Best Software Tutorials videos'}} - Larnr Education">
        <meta name="keywords" content="{{ $keywords ?? 'free, software, development, tutorial, development tutorials' }}">
        <meta name="description" content="{{ $description ?? 'Free Software development learning channel.' }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://larnr.com/">
        <meta property="og:title" content="{{$title ?? 'Best Software Tutorials videos'}} - Larnr Education">
        <meta property="og:description" content="{{ $description ?? 'Free Software development learning channel.' }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://larnr.com/">
        <meta property="twitter:title" content="{{$title ?? 'Best Software Tutorials videos'}} - Larnr Education">
        <meta property="twitter:description" content="{{ $description ?? 'Free Software development learning channel.' }}">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ url('/') }}/imgs/app-icon-114.png" type="image/png" sizes="16x16">
        {{-- <link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.min.css">
        {{-- Laravel Mix - CSS File --}}
        @yield('headers')
        <link rel="stylesheet" href="{{ asset('css/larnr.css') }}">
        <link href="{{ url('/') }}/css/style.css" rel="stylesheet">
        @yield('styles')


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
        @include('larnr::layouts.header')
        <div style="margin-top:60px">
            @yield('content')
        </div>
        @include('larnr::layouts.footer')
        {{-- Laravel Mix - JS File --}}
        @yield('footers')
        <script src="{{ asset('js/larnr.js') }}"></script>
        <script src="{{url('/')}}/js/jquery.min.js"></script>
        <script src="{{url('/')}}/js/script.js"></script>
        @yield('scripts')
    </body>
</html>
