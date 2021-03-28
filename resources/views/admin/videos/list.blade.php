@extends('admin.videos.layout')

@section('videocontent')
<div class="row">
    @foreach ($videos as $video)
    <div class="col-md-3">
        <div class="card">
            <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
            <div class="card-body">
              <h5 class="card-title">{{ Str::substr($video->title, 0, 20) }}...</h5>
              <p class="card-text">{{ Str::substr($video->description, 0, 60)}}...</p>
              <div class="text-center">
                <div class="btn-group">
                    <a href="{{ url('admin/video/'. $video->id)}}" class="btn btn-primary">View</a>
                    <a href="{{ url('admin/video/'. $video->id . '/edit')}}" class="btn btn-warning">Edit</a>
                    <a href="{{ url('admin/video/'. $video->id)}}" class="btn btn-danger">Delete</a>
                  </div>
              </div>
            </div>
          </div>
    </div>
    @endforeach
</div>

@endsection
