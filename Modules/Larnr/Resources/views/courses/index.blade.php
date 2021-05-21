@extends('larnr::layouts.master')

@section('content')
@include('larnr::courses.display')
<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-10">
            {{-- Course List --}}
            <div class="row">
                @foreach ($courses as $course)
                {{-- @if($learn->course->status == 'active') --}}
                <div class="col-12 col-sm-6 col-md-3 block p-2">
                    <h4 class="text-center m-0">{{ $course->title }}</h4>
                    <div class="py-2">
                        <div class="text-justify py-2">
                            {{$course->meta_desc}}.
                        </div>
                        <div class="text-justify p-2">
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
                    <div class="text-center px-4">
                        <div class="btn-group">
                            <a href="{{ url('course/'. $course->slag) }}" class="btn btn-primary">Learn More</a>
                            <a href="{{ url('bill/'. '?cid='. $course->id)}}" class="btn btn-warning">Enroll Now</a>
                            {{-- <button class="btn btn-warning" onclick="checkout('{{$course->title}}', {{$price}})">Enroll Now</button> --}}
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
