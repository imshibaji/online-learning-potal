@extends('larnr::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card m-2">
                <x-video src="{{ url('storage/'.$video->video_path) }}" poster="{{ url('storage/'.$video->image_path) }}" />
                <div class="card-header my-auto"><h5 class="my-auto">{{$video->title}}</h5></div>
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
        <div class="col-md-3 d-none d-md-block">
            @foreach ($videos as $video)
                <div class="card m-2">
                    <a href="{{ url('v/'.base64_encode($video->id)) }}">
                        <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
                        <div class="card-body">
                            <h5 class="card-title my-auto">{{ $video->title }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
