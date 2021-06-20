@extends('larnr::layouts.master')

@section('title', 'Best Hindi Software Development Tutorials')
@section('keywords', 'Hindi Tutorials, Courses, tutorials, best hindi tutorials, software development tutorials')
@section('description', 'You can learn professional software development step by step trainings and tutorials from best expert trainers. They will be helpng you for your learning needs and also helping you to build for best career.')
@section('og_type', 'website')

@section('content')
@include('larnr::courses.display')
<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-10">
            {{-- Course List --}}
            <div class="row">
                @foreach ($courses as $course)
                <div class="col-md-4 mt-3">
                    <div class="card h-100 box">
                        @if($course->ribbon)
                            <div class="ribbon-left"><span>{{$course->ribbon}}</span></div>
                        @endif
                        @if($course->image_path)
                            <a href="{{ url('course/'.$course->slag) }}">
                                <img height="190" src="{{ url('storage/'.$course->image_path) }}" class="card-img-top" alt="{{$course->title}}">
                            </a>
                        @endif
                        <div class="card-body">
                            <h5 class="text-justify"><a href="{{ url('course/'. $course->slag) }}">{{ $course->title }}</a></h5>
                            <div class="pb-3">
                                @include('larnr::components.course-list-star', [
                                    'star' => 4.5,
                                    'reviews' => 49,
                                    'language' => $course->language
                                ])
                            </div>
                            <div class="py-2">
                                <div class="text-justify">
                                    {{$course->meta_desc}}.
                                </div>
                                <div class="text-justify p-3">
                                    Duration: {{ $course->duration }}<br/>
                                    Price:
                                    @if($course->offer_price != null)
                                        <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                                        <strong class="text-success">₹{{ $course->offer_price }}/-</strong>
                                    @else
                                        <strong class="text-success">₹{{ $course->actual_price }}/-</strong>
                                    @endif<br/>
                                    Accessible: <strong class="text-success">{{ ucwords($course->accessible) }}</strong>
                                </div>
                            </div>
                            <div class="text-justify">
                                <div class="btn-group btn-block">
                                    <a href="{{ url('course/'. $course->slag) }}" class="btn btn-primary">Learn More</a>
                                    <a href="{{ route('checkout', ['cid' => $course->id ])}}" class="btn btn-warning">Enroll Now</a>
                                    {{-- <button class="btn btn-warning" onclick="checkout('{{$course->title}}', {{$price}})">Enroll Now</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- Course List --}}
        </div>
    </div>
</div>
@endsection
