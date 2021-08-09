@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Courses</div>
            <div class="col text-right">
                <a href="{{ route('teachercourses.index') }}">Back to Course List</a> |
                @if($course->topics)
                    <a href="{{ route('teachertopics.index', ['cid' => $course->id]) }}">View Topics</a> |
                @endif
                <a href="{{ route('teachercourses.edit', $course->id) }}">Edit Course</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md order-2 order-md-1">
                    <div class="row">
                        <div class="col p-3 text-center"><i class="fa fa-eye" aria-hidden="true"></i> {{$course->views}}</div>
                        <div class="col p-3 text-center"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> {{$course->sales}}</div>
                        <div class="col p-3 text-center"><i class="fa fa-star" aria-hidden="true"></i> {{$course->rateing ?? 0.0 }}</div>
                        <div class="col p-3 text-center"><i class="fa fa-file-text" aria-hidden="true"></i> {{$course->reviews ?? 0}}</div>
                    </div>
                    <div class="row">
                        <div class="col p-3 text-center"><strong>Created At</strong> <p>{{$course->created_at}}</p></div>
                        <div class="col p-3 text-center"><strong>Modified At</strong> <p>{{$course->updated_at}}</p></div>
                        <div class="col p-3 text-center"><strong>Realease Status</strong> <p>{{$course->status}}</p></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-justify">{{ Str::substr($course->meta_desc, 0, 300) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md order-1 order-md-2">
                    @if(isset($course->embed_code))
                        <x-video poster="{{ ($course->image_path)? url('storage/'.$course->image_path) : url('images/image-upload.jpg') }}" src="{{$course->embed_code}}" type="video/youtube" />
                    @else
                        <div class="mt-0">
                            <img class="img-fluid mb-3" src="{{ ($course->image_path)? url('storage/'.$course->image_path) : url('images/image-upload.jpg') }}" alt="{{$course->title}}" />
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4 class="mt-3">{{$course->title}}</h4>
                    <div class="mb-0">
                        @if ($course->meta_keys != "")
                            @foreach(explode(',', $course->meta_keys) as $keyword)
                                <span class="badge bg-secondary text-white">{{$keyword}}</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="mb-4">
                        <small>{{$course->meta_desc}}</small>
                    </div>
                    <div>{!! $course->details !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
