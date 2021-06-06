@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Topic View</div>
            <div class="col text-right">
                <a href="{{ route('teachertopics.index', ['cid' => $topic->course->id]) }}">Back to Topics List</a> |
                <a href="{{ route('teachertopics.edit', $topic->id) }}">Edit Topic</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h1>{{$topic->title}}</h1>
        <div class="py-2">
            @isset($topic->video)
                <x-video src="{{url('storage/'.$topic->video->video_path)}}" poster="{{ url('storage/'.$topic->video->image_path ) }}" />
            @endisset
            @isset($topic->embed_code)
                <x-video src="{{$topic->embed_code}}" type="video/youtube" poster="{{ $topic->image_path? url('storage/'.$topic->image_path ) : null }}" />
            @endisset
        </div>
        <div>{!! $topic->details !!}</div>
    </div>
</div>
@endsection
