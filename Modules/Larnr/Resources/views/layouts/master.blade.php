<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@section('title') Best Software Development Tutorials @show | Larnr Education </title>

        {{-- Theame Color --}}
        <meta name="theme-color" content="#3490dc">
        <!-- Primary Meta Tags -->
        <meta name="title" content="@yield('title', 'Best Software Tutorials videos') - Larnr Education">
        <meta name="keywords" content="@yield('keywords', 'elearning, learning portal, education, education poratls, best teacher, free learning articles, tutorials, courses, tutorial, development tutorials')">
        <meta name="description" content="@yield('description', 'India\'s best learning platform for the students and learners. If you want to best career guidance and supports join this community for Free Software development elearning portal.')">
        <meta name="author" content="@yield('author', 'Larnr Education')">

        <!-- Open Graph / Facebook -->
        <meta property="og:title" content="@yield('title', 'Best Software Tutorials videos') - Larnr Education">
        <meta property="og:description" content="@yield('description', 'India\'s best learning platform for the students and learners. If you want to best career guidance and supports join this community for Free Software development elearning portal.')">
        <meta property="fb:app_id" content="791303937614726">
        <meta property="og:type" content="@yield('og_type', 'website')">
        <meta property="og:url" content="@yield('og_url', url('/'))">
        <meta property="og:image" content="@yield('og_image', 'https://www.larnr.com/images/screen.jpg')">
        <meta property="og:video" content="@yield('og_video', 'https://www.larnr.com/videos/intro2.mp4' )">
        <meta property="og:video:type" content="@yield('og_video_type', 'video/mp4')">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:title" content="@yield('title', 'Best Software Tutorials videos') - Larnr Education">
        <meta property="twitter:description" content="@yield('description', 'India\'s best learning platform for the students and learners. If you want to best career guidance and supports join this community for Free Software development elearning portal.')">
        <meta property="twitter:url" content="@yield('og_url', url('/'))">
        <meta property="twitter:image" content="@yield('og_image', 'https://www.larnr.com/images/screen.png')">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="fb:pages" content="621683681208701" />
        <link rel="canonical" href="@yield('canonical', url()->current())" />

        {{-- <link rel="icon" href="{{ url('/') }}/imgs/app-icon-114.png" type="image/png" sizes="16x16"> --}}
        <link rel="icon" href="/favicon.ico" sizes="16x16 32x32" type="image/ico">
        {{-- <link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.min.css">
        {{-- Laravel Mix - CSS File --}}
        @yield('headers')
        <link rel="stylesheet" href="{{ asset('css/larnr.css') }}">
        <link rel="stylesheet" href="{{ url('/') }}/css/prism_coy.css">
        @yield('styles')

        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1387222468543405"
        crossorigin="anonymous"></script>
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
        @include('larnr::layouts.header1')
        <div style="margin-top:50px">
            @yield('content')
        </div>
        @include('larnr::layouts.footer')
        {{-- Laravel Mix - JS File --}}
        @yield('footers')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script src="{{url('/')}}/js/jquery.min.js"></script>
        <script src="{{url('/')}}/js/bootstrap.min.js"></script>
        {{-- <script src="{{ asset('js/larnr.js') }}"></script> --}}
        <script src="{{url('/')}}/js/script.js"></script>
        <script src="{{url('/')}}/js/prism_patched.min.js"></script>
        @yield('scripts')
    </body>
</html>
