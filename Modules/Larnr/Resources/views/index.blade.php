@extends('larnr::layouts.master')

@section('content')
@include('larnr::homes.display')
@include('larnr::homes.catagory')
@include('larnr::homes.articles')
{{-- @include('larnr::homes.videos') --}}
@include('larnr::homes.courses')
@include('larnr::homes.teachers')
@include('larnr::homes.testimonials')
{{-- @include('larnr::homes.partner') --}}
@include('larnr::homes.sponsor')
@endsection
