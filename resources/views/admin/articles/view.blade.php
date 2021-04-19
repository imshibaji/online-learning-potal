@extends('admin.videos.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/video') }}" class="btn btn-primary">Video Show</a>
    </div>
@endsection

@section('videocontent')
<x-video src="{{ url('storage/'.$video->video_path) }}" poster="{{ url('storage/'.$video->image_path) }}" />
@endsection
