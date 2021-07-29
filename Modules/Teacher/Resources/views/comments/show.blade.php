@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Comment for: {{$comment->commentable->title}}</div>
            <div class="col text-right"><a href="{{ route('teachercomments.index') }}">Comment List</a></div>
        </div>
    </div>
    <div class="card-body">
        <div>{{$comment->message}}</div>
        <small>Comment By: {{$comment->user->fullname()}}</small>
        @if($comment->replies)
            @foreach ($comment->replies as $reply)
                <div class="media mt-1 ml-3">
                    <div class="media-body">
                        <h6 class="m-0">Replied:</h6>
                        <p><strong>{{$reply->user->fullname()}}: </strong>{{$reply->message}}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="card-footer">
        <div class="p-1">
            <form action="{{ route('teachercomments.store') }}" method="POST">
                @csrf
              <input type="hidden" name="cid" value="{{$comment->id}}" />
              <textarea name="message" class="form-control"></textarea>
              <div class="text-right">
                <input class="btn btn-primary btn-sm" type="submit" value="Comment Now" />
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
