@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Comments</div>
            <div class="col text-right"><a href="{{ route('teachercomments.create') }}">Create Comment</a></div>
        </div>
    </div>
    <div class="card-body">
        @foreach ($comments as $cmt)
        <div class="media">
            @if($cmt->commentable)
            <img src="{{ url('storage/'.$cmt->commentable->image_path)}}" class="mr-3" width="60px" alt="{{$cmt->commentable->title}}">
            <div class="media-body">
                <h5 class="m-0"><span class="text-success">{{$cmt->commentable->title}}</span></h5>
                <p class="p-0 m-0">{{$cmt->message}}</p>
                <p class="p-0 m-0 ml-3 mb-1">- By {{$cmt->user->fullname()}}</p>
                @if($cmt->replies)
                @foreach ($cmt->replies as $reply)
                    <div class="media mt-1 ml-3">
                        {{-- <a class="mr-3" href="#">
                        <img src="..." alt="...">
                        </a> --}}
                        <div class="media-body">
                        <h6 class="m-0">Replied by {{$reply->user->fullname()}}</h6>
                        <p>{{$reply->message}}</p>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
