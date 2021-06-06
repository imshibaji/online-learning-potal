@extends('layouts.user')

@section('content')
<div class="container-fluid">
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
                <a href="{{ url('/') }}/user/course-details/{{$course->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-preview/'.$course->id) ? 'active' : '' }}">
                  Course Overview
                </a>
                @foreach ($topics as $ta)
                    @if($ta->status == 'active')
                        <a href="{{ url('/') }}/user/course-details/{{$course->id}}/{{$ta->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-preview/'.$course->id.'/'.$ta->id) ? 'active' : '' }}">{{ $ta->title }}</a>
                    @endIf
                @endforeach
            </div>
            {{-- End Menu Index --}}
        </div>
        {{-- End Left --}}

        {{-- Start Right --}}
        <div class="col-md-9 order-1">
            <div id="course_content">
                @if ($topic)
                    <h1 class="text-center">{{$topic->title}}</h1>
                    <div class="py-3">
                        @isset($topic->video)
                            <x-video src="{{url('storage/'.$topic->video->video_path)}}" poster="{{ url('storage/'.$topic->video->image_path ) }}" />
                        @endisset
                        @isset($topic->embed_code)
                            <x-video src="{{$topic->embed_code}}" type="video/youtube" poster="{{ $topic->image_path? url('storage/'.$topic->image_path ) : null }}" />
                        @endisset
                    </div>
                    @include('users.learn.contents')
                @else
                    <div style="min-height: 650px">
                        <h1 class="text-center">{{ $course->title }}</h1>
                        <div class="my-2">
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
                            {!! $course->details !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        {{-- End Right --}}
</div>

</div>
@endsection



@section('headers')
{{-- <link rel="stylesheet" href="{{url('/')}}/css/prism_patched.min.css"> --}}
<link rel="stylesheet" href="{{url('/')}}/css/prism_coy.css">
@endsection

@section('scripts')
<script src="{{url('/')}}/js/prism_patched.min.js"></script>
{{-- <script src="{{url('/')}}/js/prism.js"></script> --}}
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
