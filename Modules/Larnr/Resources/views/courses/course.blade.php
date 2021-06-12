@extends('larnr::layouts.master')

@section('content')
@include('larnr::courses.course-display')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="my-2 text-justify">
                {!! $course->details !!}
            </div>
            {{-- Course List --}}
            <ul class="list-group">
                @foreach ($course->topics()->publish()->orderBy('short')->get() as $topic)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fa fa-video"></i> {{$topic->title}}</span>
                        @if ($topic->premium_status == 'free')
                            <a href="{{ url('/') }}/course-preview/{{$course->id}}/{{$topic->id}}" class="btn btn-primary text-white">
                            <i class="fa fa-play"></i> Preview
                            </a>
                        @else
                            <a href="{{ url('/') }}/course-preview/{{$course->id}}/{{$topic->id}}" class="btn btn-warning"><i class="fa fa-trophy"></i> Premium</a>
                        @endif
                    </li>
                @endforeach
            </ul>
            {{-- Course List --}}
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="ribbon-left"><span>POPULAR</span></div>
                @if($course->image_path)
                    <a href="{{ url('course/'.$course->slag) }}">
                        <img height="140" src="{{ url('storage/'.$course->image_path) }}" class="card-img-top" alt="{{$course->title}}">
                    </a>
                @endif
                {{-- <div class="card-header"><h5>Course Description</h5></div> --}}
                <div class="card-body">
                    <div class="text-justify">
                        {{$course->meta_desc}}.
                    </div>
                    <div class="py-3">
                        <div>Price:
                        @if($course->offer_price != null)
                            <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                            <strong class="text-success">₹{{ $course->offer_price }}/-</strong>
                        @else
                            <strong class="text-success">₹{{ $course->actual_price }}/-</strong>
                        @endif
                        </div>
                        <div>Duration: <strong class="text-success">{{ $course->duration }}</strong></div>
                        <div>Accessible: <strong class="text-success">{{ ucwords($course->accessible) }}</strong></div>
                        <div>Mode: <strong>Online</strong></div>
                    </div>
                    <div class=""><a href="{{url('bill/'. '?cid='. $course->id)}}" class="btn btn-warning btn-sm btn-block">Buy Now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
