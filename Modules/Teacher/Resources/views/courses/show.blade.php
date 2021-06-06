@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Courses</div>
            <div class="col text-right">
                <a href="{{ route('teachercourses.index') }}">Back to Course List</a> |
                @if($course->topics)
                    <a href="{{ route('teachertopics.index', ['cid' => $course->id]) }}">View Topics</a> |
                @endif
                <a href="{{ route('teachercourses.edit', $course->id) }}">Edit Course</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>{{$course->title}}</h1>
                    <div class="py-2">
                        @isset($course->video->video_path)
                            <x-video src="{{url('storage/'.$course->video->video_path)}}" poster="{{ url('storage/'.$course->video->image_path ) }}" />
                        @endisset
                        @isset($course->embed_code)
                            <x-video src="{{$course->embed_code}}" type="video/youtube" poster="{{ $course->image_path? url('storage/'.$course->image_path ) : null }}" />
                        @endisset
                    </div>
                    <div>{!! $course->details !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
