@extends('user::layouts.base')

@section('title')
    @if ($topic)
        {{$topic->title}}
    @else
        {{$course->title}}
    @endif
@endsection

@section('content')
<div class="container-fluid">
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        {{-- Start Left --}}
        <div class="col-md-9 order-1 p-0">
            <div class="scrollbar">
                <div id="course_content">
                    @if ($topic)
                        <div class="p-0">
                            @isset($topic->video)
                                <x-video src="{{url('storage/'.$topic->video->video_path)}}" poster="{{ url('storage/'.$topic->video->image_path ) }}" />
                            @endisset
                            @isset($topic->embed_code)
                                <x-video src="{{$topic->embed_code}}" type="video/youtube" poster="{{ $topic->image_path? url('storage/'.$topic->image_path ) : null }}" />
                            @endisset
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>{{$topic->title}}</h5>
                            </div>
                            <div class="card-body p-0">
                                @include('users.learn.contents')
                            </div>
                        </div>
                    @else
                        <div class="p-0" style="min-height: 650px">
                            @isset($course->video->video_path)
                                <div class="pb-2">
                                    <x-video src="{{url('storage/'.$course->video->video_path)}}" poster="{{ url('storage/'.$course->video->image_path ) }}" />
                                </div>
                            @endisset
                            @isset($course->embed_code)
                                <div class="pb-2">
                                    <x-video src="{{$course->embed_code}}" type="video/youtube" poster="{{ $course->image_path? url('storage/'.$course->image_path ) : null }}" />
                                </div>
                            @endisset
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="mt-2">{{ $course->title }}</h5>
                                        </div>
                                        <div class="col-3 text-right">
                                            @php
                                                $ta = $topics[0];
                                            @endphp
                                            @if($ta->status == 'active')
                                                <a href="{{ url('/') }}/user/course-details/{{$course->id}}/{{$ta->id}}" class="btn btn-primary btn-sm">
                                                    Topics <i class="fa fa-arrow-down fa-sm" aria-hidden="true"></i>
                                                </a>
                                            @endIf
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="my-2">
                                        {!! $course->details !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- @include('layouts.common.footer') --}}
        </div>
        {{-- End Left --}}

        {{-- Start Right --}}
        <div class="col-md-3 order-2 d-none d-md-block p-0">
            <div class="scrollbar">
                <div class="list-group pb-2">
                    <li class="list-group-item">
                        <h5>Course Index</h5>
                    </li>
                    <a href="{{ url('/') }}/user/course-details/{{$course->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-details/'.$course->id) ? 'active' : '' }}">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        Course Overview
                    </a>
                    <div class="accordion" id="accordionExample">
                    @foreach ($sections as $section)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$section->id}}">
                            <button class="accordion-button {{ $section->topics()->find(Request::segment(4))? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$section->id}}" aria-expanded="{{ $section->topics()->find(Request::segment(4))? 'true' : 'false' }}" aria-controls="collapse{{$section->id}}">
                                {{$section->title}}
                            </button>
                            </h2>
                            <div id="collapse{{$section->id}}" class="accordion-collapse collapse {{ $section->topics()->find(Request::segment(4))? 'show' : 'hide' }}" aria-labelledby="heading{{$section->id}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body p-0">
                                @foreach ($section->topics as $ta)
                                    @if($ta->status == 'active')
                                        <a href="{{ url('/') }}/user/course-details/{{$course->id}}/{{$ta->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-details/'.$course->id.'/'.$ta->id) ? 'active' : '' }}">
                                            <i class="fa fa-book" aria-hidden="true"></i>
                                            {{ $ta->title }}
                                        </a>
                                    @endIf
                                @endforeach
                            </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            {{-- End Menu Index --}}
            </div>
        </div>
        {{-- End Right --}}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{url('/')}}/js/prism_patched.min.js"></script>
{{-- <script src="{{url('/')}}/js/prism.js"></script> --}}
@endsection

@section('headers')
{{-- <link rel="stylesheet" href="{{url('/')}}/css/prism_patched.min.css"> --}}
<link rel="stylesheet" href="{{url('/')}}/css/prism_coy.css">
<style>
.scrollbar {
  height: 95vh;
  /* border: 1px dotted black; */
  overflow-y: scroll; /* Add the ability to scroll */
}

/* Hide scrollbar for Chrome, Safari and Opera */
.scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.scrollbar {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>
@endsection

{{--
@section('headers')
{{-- <link rel="stylesheet" href="{{url('/')}}/css/prism_patched.min.css"> --
<link rel="stylesheet" href="{{url('/')}}/css/prism_coy.css">
<style>
.nogap{
    padding: 0px !important;
}
</style>
@endsection
@section('scripts')
<script src="{{url('/')}}/js/prism_patched.min.js"></script>
{{-- <script src="{{url('/')}}/js/prism.js"></script> --
<script>
function onChange(el){
    console.log(el.value);
    window.location.replace(el.value);
}
</script>
@endsection --}}
