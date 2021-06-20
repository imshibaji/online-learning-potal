@extends('layouts.user')

@section('content')
<div class="container-fluid">
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        @if($topic)
                            {{$topic->title}}
                        @else
                            {{$course->title}}
                        @endif
                    </h5>
                </div>

                <div class="card-body" style="min-height: 600px">


                    <div class="row">
                        {{-- Start Right --}}
                        <div class="col-md-12">
                            <div id="course_content">
                                @if ($topic)
                                        {{-- <h1 class="text-center">{{$topic->title}}</h1> --}}
                                        @if($topic->video)
                                        <div class="row" style="padding: 0px 15px">
                                            <div class="col-md-9 nogap py-3">
                                                {{-- {!! $topic->embed_code !!} --}}
                                                <x-video src="{{url('storage/'.$topic->video->video_path)}}" poster="{{ url('storage/'.$topic->video->image_path ) }}" />
                                                @include('users.learn.contents')
                                            </div>
                                            <div class="col-md-3 nogap">
                                                <div class="list-group pb-2 d-none d-md-block">
                                                    @foreach ($topics as $ta)
                                                        @if($ta->status == 'active')
                                                            <a href="{{ url('/') }}/user/course-details/{{$course->id}}/{{$ta->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-details/'.$course->id.'/'.$ta->id) ? 'active' : '' }}">{{ $ta->title }}</a>
                                                        @endIf
                                                    @endforeach
                                                </div>
                                                {{-- Small Screen --}}
                                                <div class="list-group pb-2 d-block d-md-none">
                                                    <select class="form-control" onchange="onChange(this)">
                                                        @foreach ($topics as $ta)
                                                            @if($ta->status == 'active')
                                                                <option value="{{ url('/') }}/user/course-details/{{$course->id}}/{{$ta->id}}" {{ Request::is('user/course-details/'.$course->id.'/'.$ta->id) ? 'selected' : '' }}>{{ $ta->title }}</option>
                                                            @endIf
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- @include('users.learn.contents') --}}
                                        @else
                                            <div class="row">
                                                <div class="col-md-9 py-3">
                                                    @isset($topic->embed_code)
                                                        <x-video src="{{$topic->embed_code}}" type="video/youtube" poster="{{ url('storage/'.$topic->image_path ) }}" />
                                                    @endisset
                                                    @include('users.learn.contents')
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="list-group pb-2 d-none d-md-block">
                                                        @foreach ($topics as $ta)
                                                            @if($ta->status == 'active')
                                                                <a href="{{ url('/') }}/user/course-details/{{$course->id}}/{{$ta->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-details/'.$course->id.'/'.$ta->id) ? 'active' : '' }}">{{ $ta->title }}</a>
                                                            @endIf
                                                        @endforeach
                                                    </div>
                                                    {{-- Small Screen --}}
                                                    <div class="list-group pb-2 d-block d-md-none">
                                                        <select class="form-control" onchange="onChange(this)">
                                                            @foreach ($topics as $ta)
                                                                @if($ta->status == 'active')
                                                                    <option value="{{ url('/') }}/user/course-details/{{$course->id}}/{{$ta->id}}" {{ Request::is('user/course-details/'.$course->id.'/'.$ta->id) ? 'selected' : '' }}>{{ $ta->title }}</option>
                                                                @endIf
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- @include('users.learn.contents') --}}
                                @else
                                    @foreach ($topics as $key => $ta)
                                        @if($ta->status == 'active')
                                            @if($key==0)
                                                <script>
                                                   window.location.replace( '{{url("/user/course-details/$course->id/$ta->id")}}' );
                                                </script>
                                            @endif
                                        @endIf
                                    @endforeach

                                    <h1 class="text-center">{{ $course->title }}</h1>
                                    <div class="my-2">
                                        @isset($course->video->video_path)
                                        <div class="pb-2">
                                            <x-video src="{{url('storage/'.$course->video->video_path)}}" poster="{{ url('storage/'.$course->video->image_path ) }}" />
                                        </div>
                                        @endisset
                                        @isset($course->embed_code)
                                        <div class="pb-2">
                                            <x-video src="{{$course->embed_code}}" type="video/youtube" poster="{{ url('storage/'.$course->image_path ) }}" />
                                        </div>
                                        @endisset
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
@endsection


@section('headers')
{{-- <link rel="stylesheet" href="{{url('/')}}/css/prism_patched.min.css"> --}}
<link rel="stylesheet" href="{{url('/')}}/css/prism_coy.css">
<style>
.nogap{
    padding: 0px !important;
}
</style>
@endsection

@section('scripts')
<script src="{{url('/')}}/js/prism_patched.min.js"></script>
{{-- <script src="{{url('/')}}/js/prism.js"></script> --}}
<script>
function onChange(el){
    console.log(el.value);
    window.location.replace(el.value);
}
</script>
@endsection