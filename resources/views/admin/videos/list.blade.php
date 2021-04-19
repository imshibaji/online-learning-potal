@extends('admin.videos.layout')

@section('videocontent')
<div class="row p-1 my-0">
    @foreach ($videos as $video)
    <div class="col-md-3 p-1 my-0">
        <div class="card">
            <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
            <div class="card-body">
              <h6 class="card-title">{{ Str::substr($video->title, 0, 28) }}</h6>
              <p class="card-text">{{ Str::substr($video->description, 0, 50)}}...</p>
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
<div class="row">
    <div class="col-12 d-flex justify-content-center pt-4">
        {{ $videos->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
