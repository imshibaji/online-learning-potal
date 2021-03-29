@extends('larnr::layouts.master')

@section('content')
@include('larnr::layouts.display')
<div class="container-fluid">

    <div class="row">
        @foreach ($videos as $video)
        <div class="col-md-3">
            <div class="card my-3">
                <a href="{{ url('v/'.base64_encode($video->id)) }}">
                    <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
                </a>
                <div class="card-body">
                    <a href="{{ url('v/'.base64_encode($video->id)) }}">
                        <h6 class="card-title my-1">{{ $video->title}}</h6>
                    </a>
                    {{-- <p class="card-text">{{ Str::substr($video->description, 0, 50)}}...</p> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
