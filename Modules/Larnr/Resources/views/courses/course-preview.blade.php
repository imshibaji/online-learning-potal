@extends('larnr::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row">

                {{-- Start Left --}}
                <div class="col-md-3 order-2">
                    <div class="list-group pb-2">
                        <li class="list-group-item">
                            <h5>Topic Index</h5>
                        </li>
                        <a href="{{ url('/') }}/course-preview/{{$course->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-preview/'.$course->id) ? 'active' : '' }}">
                            Overview
                        </a>
                        @foreach ($topics as $ta)
                            @if($ta->status == 'active' && $ta->premium_status =="free")
                                <a href="{{ url('/') }}/course-preview/{{$course->id}}/{{$ta->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-preview/'.$course->id.'/'.$ta->id) ? 'active' : '' }}">{{ $ta->title }}</a>
                            @endIf
                        @endforeach
                    </div>
                    {{-- End Menu Index --}}
                </div>
                {{-- End Left --}}

                {{-- Start Right --}}
                <div class="col-md-9 order-1">

                    <div id="course_content" style="min-height: 650px">
                        @if ($topic)
                            @if ($topic->premium_status =="free")
                                <h1 class="text-center">{{$topic->title}}</h1>
                                <div class="py-3">
                                    @isset($topic->video)
                                        <x-video src="{{url('storage/'.$topic->video->video_path)}}" poster="{{ url('storage/'.$topic->video->image_path ) }}" />
                                    @endisset
                                    @isset($topic->embed_code)
                                        <x-video src="{{$topic->embed_code}}" type="video/youtube" poster="{{ url('storage/'.$topic->image_path ) }}" />
                                    @endisset
                                </div>
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
                                <div class="pb-2">
                                    @isset($topic->video)
                                        <x-video src="{{url('storage/'.$topic->video->video_path)}}" poster="{{ url('storage/'.$topic->video->image_path ) }}" />
                                    @endisset
                                    @isset($topic->embed_code)
                                        <x-video src="{{$topic->embed_code}}" type="video/youtube" poster="{{ url('storage/'.$topic->image_path ) }}" />
                                    @endisset
                                </div>
                                {!! $course->details !!}
                            </div>
                        @endif
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
