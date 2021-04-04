@extends('larnr::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9 p-0 py-sm-2">
            <div class="card m-2">
                <x-video src="{{ url('storage/'.$video->video_path) }}" url="{{$og_url}}" poster="{{ url('storage/'.$video->image_path) }}" />
                <div class="card-header my-auto">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="my-auto">{{$video->title}}</h5>
                            <small class="my-1 card-text text-muted"><span class="d-none d-sm-inline">Course: </span>{{ $course ?? 'Skill Learning Tutorials' }}</small>
                        </div>
                        <div class="col-4 text-right">
                            <small class="my-1 card-text text-muted">{{$author ?? 'Larnr Education'}} <span class="d-none d-sm-inline"> | </span> {{rand(100,1000)}}views </small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6>Details</h6>
                    {!! $video->details !!}
                </div>
                {{-- <div class="card-footer">
                    <form action="#" method="POST">
                        <textarea class="form-control" name="comment" placeholder="Enter Your Comment"></textarea>
                        <button type="submit" class="btn btn-primary">Comment Now</button>
                    </form>
                </div> --}}
                {{-- <x-comments /> --}}
            </div>
        </div>
        <div class="col-md-3 col-12 p-0 pr-md-2 py-sm-2">
            <div class="row px-2">
                @foreach ($videos as $video)
                <div class="col-6 col-md-12 my-2">
                    <div class="card box my-0 pb-0 h-100 h-sm-none">
                        <a style="text-decoration: none" href="{{ url('v/'.base64_encode($video->id)) }}">
                            <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
                            <div class="card-body p-1 p-sm-3">
                                <h6 class="card-title my-1">{{ Str::substr($video->title, 0, 35) }}</h6>
                                <small class="d-none d-md-inline card-text text-dark">{{ Str::substr($video->description, 0, 40)}}...</small><br class="d-none d-md-inline">
                                <small class="my-1 card-text text-muted">{{$author ?? 'Larnr Education'}} <span class="d-none d-sm-inline"> | </span> {{rand(100,1000)}}views</small>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
