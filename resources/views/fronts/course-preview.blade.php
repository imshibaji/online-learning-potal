@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Course Preview</div>

                <div class="card-body" style="min-height: 600px">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-group pb-2">
                                <li class="list-group-item">
                                    <h5>Topic Index</h5>
                                </li>
                                <a href="{{ route('homecpreview', $course->id) }}" class="list-group-item list-group-item-action {{ Request::is('course-preview/'.$course->id) ? 'active' : '' }}">
                                  Overview
                                </a>
                                @foreach ($topics as $ta)
                                    @if($ta->status == 'active')
                                        <a href="{{ url('/') }}/course-preview/{{$course->id}}/{{$ta->id}}" class="list-group-item list-group-item-action {{ Request::is('course-preview/'.$course->id.'/'.$ta->id) ? 'active' : '' }}">{{ $ta->title }}</a>
                                    @endIf
                                @endforeach
                            </div>
                            {{-- End Menu Index --}}
                        </div>
                        {{-- End Left --}}

                        {{-- Start Right --}}
                        <div class="col-md-8">

                            <div id="course_content">
                                @if ($topic)
                                    @if ($topic->premium_status =="free")
                                        <h1 class="text-center">{{$topic->title}}</h1>
                                        <div class="py-3">{!! $topic->embed_code !!}</div>
                                        @include('users.learn.contents')
                                    @else
                                        <h1 class="text-center">You have no access on this course. Please enroll this course for full access.</h1>
                                        <div class="text-center">
                                            <a href="{{route('bill', ['cid'=> $course->id])}}" class="btn btn-warning btn-lg">Enroll Now</a>
                                        </div>
                                    @endif
                                @else
                                    <h1 class="text-center">{{ $course->title }}</h1>
                                    <div class="my-2">
                                        {!! $course->details !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @include('layouts.modal') --}}
@endsection


@section('headers')
{{-- <link rel="stylesheet" href="{{url('/')}}/css/prism_patched.min.css"> --}}
<link rel="stylesheet" href="{{url('/')}}/css/prism_coy.css">
@endsection

@section('scripts')
<script src="{{url('/')}}/js/prism_patched.min.js"></script>
{{-- <script src="{{url('/')}}/js/prism.js"></script> --}}
@endsection