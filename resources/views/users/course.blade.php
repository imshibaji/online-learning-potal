@extends('layouts.user')

@section('content')
<div id="app" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Course Details</div>

                <div class="card-body" style="min-height: 600px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <h1 class="text-center">{{ $course->title }}</h1>
                    <div class="text-center">
                        Price:
                        @if($course->offer_price != null)
                            <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                            <strong class="text-success">₹{{ $course->offer_price }}/-</strong>,
                        @else
                        <strong class="text-success">₹{{ $course->actual_price }}/-</strong>,
                        @endif
                        Duration: <strong class="text-success">{{ $course->duration }}</strong>,
                        Accessible: <strong class="text-success">{{ ucwords($course->accessible) }}</strong>

                        {{-- @php
                            $price = $course->actual_price;
                            if($course->offer_price){
                                $price = $course->offer_price;
                            }
                        @endphp
                        <button class="btn btn-warning btn-sm" onclick="checkout('{{ $course->title }}', {{$price}})">Enroll Now</button> --}}
                        <a href="{{route('bill', ['cid'=> $course->id])}}" class="btn btn-warning btn-sm">Enroll Now</a>
                    </div>

                    <div class="my-2 mx-5 px-5">
                        <div class="pb-2">
                            @if(isset($course->video->video_path))
                            <x-video src="{{url('storage/'.$course->video->video_path)}}" poster="{{ url('storage/'.$course->video->image_path ) }}" />
                            @endif
                        </div>
                        {!! $course->details !!}
                    </div>

                    {{-- Course List --}}
                    <ul class="list-group mx-md-5 px-md-5">
                        @foreach ($course->topics()->orderBy('short')->get() as $topic)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fa fa-video"></i> {{$topic->title}}</span>
                                @if ($topic->premium_status == 'free')
                                    <a href="{{ url('/') }}/user/course-preview/{{$course->id}}/{{$topic->id}}" class="btn btn-primary text-white">
                                       <i class="fa fa-play"></i> Preview
                                    </a>
                                @else
                                    <a href="{{ url('/') }}/user/course-preview/{{$course->id}}/{{$topic->id}}" class="btn btn-warning"><i class="fa fa-trophy"></i> Premium</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    {{-- Course List --}}
                </div>
            </div>
        </div>
    </div>
</div>


{{-- @include('layouts.modal') --}}
@endsection


@section('headers')
<style>
.block{
    margin: 0px;
}
.list-group-item{
    border-radius: 0px !important;
}
</style>
@endsection
