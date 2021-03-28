@extends('admin.videos.layout')

@section('videocontent')
<x-video src="{{ url('storage/'. $video->video_path) }}" poster="{{ url('storage/'.$video->image_path) }}" />
@endsection
