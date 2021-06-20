@extends('teacher::layouts.master')

@section('content')
<div id="dashboard" class="row">
    <div class="col-md-5 mb-3">
        @include('teacher::dashboard.article')
    </div>
    <div class="col-md-7 mb-3">
        @include('teacher::dashboard.intro')
        {{-- @include('teacher::dashboard.income')
        @include('teacher::dashboard.enquery') --}}
    </div>
    <div class="col-md-8 mb-3">
        @include('teacher::dashboard.comments')
    </div>
    <div class="col-md-4 mb-3">
        @include('teacher::dashboard.analytics')
    </div>
</div>
@endsection
