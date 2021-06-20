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
        <table class="table table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>Comments Details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $cmt)
                <tr>
                    <td>
                    <div class="media">
                        @if($cmt->commentable)
                        <img src="{{ url('storage/'.$cmt->commentable->image_path)}}" class="mr-3" width="60px" alt="{{$cmt->commentable->title}}">
                        <div class="media-body">
                            <h5 class="m-0"><span class="text-success">{{$cmt->commentable->title}}</span></h5>
                            <p class="p-0 m-0"><strong>{{$cmt->user->fullname()}}: </strong> {{$cmt->message}}</p>
                            @if($cmt->replies)
                                @foreach ($cmt->replies as $reply)
                                    <div class="media mt-1 ml-3">
                                        <div class="media-body">
                                            <h6 class="m-0">Replied:</h6>
                                            <p><strong>{{$reply->user->fullname()}}: </strong>{{$reply->message}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @endif
                    </div>
                    </td>
                    <td>
                        <div class="btn-group btn-block">
                            <a href="{{route('teachercomments.show', $cmt->id)}}" class="btn btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{route('teachercomments.edit', $cmt->id)}}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @utype('admin')
                            <button class="btn btn-danger" onclick="remove('{{ $cmt->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            @endutype
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center"><h1>No Comments Found</h1></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
