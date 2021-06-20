@extends('larnr::layouts.master')

{{-- @section('title', '') --}}
@section('keywords', 'learning website, elearning website, free learning, courses, online courses')
@section('description', 'Welcomne learners, you can learning various types of learning topics, and get guidance from Exparienced and Expert Teachers.')

@section('content')
@include('larnr::homes.display')
@include('larnr::homes.catagory')
@include('larnr::homes.articles')
{{-- @include('larnr::homes.videos') --}}
@include('larnr::homes.courses')
{{-- @include('larnr::homes.teachers') --}}
{{-- @include('larnr::homes.testimonials') --}}
{{-- @include('larnr::homes.partner') --}}
@include('larnr::homes.sponsor')
@endsection
