@extends('layouts.front')

@section('content')
<div class="contents bg-light mt-2 pb-2">
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Online Courses</h4>
                    </div>

                    <div class="card-body" style="min-height: 480px">
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
                                        <a href="{{ route('homecourse', $course->slag) }}" class="btn btn-primary">Learn More</a>
                                        <a href="{{ route('bill', ['cid'=> $course->id])}}" class="btn btn-warning">Enroll Now</a>
                                        {{-- <button class="btn btn-warning" onclick="checkout('{{$course->title}}', {{$price}})">Enroll Now</button> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
@endsection
