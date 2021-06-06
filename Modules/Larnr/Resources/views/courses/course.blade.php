@extends('larnr::layouts.master')

@section('content')
@include('larnr::courses.course-display')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-9">
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
        <div class="col-md-3">
            <div class="card">
                {{-- <div class="card-header"><h5>Course Description</h5></div> --}}
                <div class="card-body">
                    <p>Price:
                    @if($course->offer_price != null)
                        <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                        <strong class="text-success">₹{{ $course->offer_price }}/-</strong>
                    @else
                    <strong class="text-success">₹{{ $course->actual_price }}/-</strong>
                    @endif
                    </p>
                    <p>Duration: <strong class="text-success">{{ $course->duration }}</strong></p>
                    <p>Accessible: <strong class="text-success">{{ ucwords($course->accessible) }}</strong></p>
                    <p>Mode: <strong>Online</strong></p>

                    <p><a href="{{url('bill/'. '?cid='. $course->id)}}" class="btn btn-warning btn-sm">Buy Now</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
