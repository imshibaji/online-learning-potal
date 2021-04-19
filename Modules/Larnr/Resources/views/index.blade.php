@extends('larnr::layouts.master')

@section('content')
@include('larnr::homes.display')
@include('larnr::homes.catagory')
@include('larnr::homes.videos')
{{-- @include('larnr::homes.partner') --}}
@include('larnr::homes.sponsor')
@endsection
