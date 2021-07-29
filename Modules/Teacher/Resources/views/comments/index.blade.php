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
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $cmt)
                <tr>
                    <td>
                    <div class="media">
                        @if($cmt->commentable)
                        <div class="mt-2">
                            <img src="{{ ($cmt->commentable->image_path)? url('storage/'.$cmt->commentable->image_path) : url('images/image-upload.jpg') }}" class="mr-3" width="60px" alt="{{$cmt->commentable->title}}">
                        </div>
                        <div class="media-body">
                            <h5 class="m-0">
                                {{-- View Btn --}}
                                <a class="text-success" href="{{route('teachercomments.show', $cmt->id)}}">
                                    <span>{{$cmt->commentable->title}}</span>
                                </a>
                            </h5>

                            <p class="p-0 m-0">
                                <strong>{{$cmt->user->fullname()}}: </strong> {{$cmt->message}}
                                <span class="m-0 ml-2">
                                    {{-- Edit Btn --}}
                                    <a class="btn btn-link p-0" href="{{route('teachercomments.edit', $cmt->id)}}" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    {{-- Delete Btn --}}
                                    <a class="btn btn-link text-danger p-0" href="{{route('teachercomments.destroy', $cmt->id)}}" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </span>
                            </p>
                            @if($cmt->replies)
                                @foreach ($cmt->replies as $reply)
                                    <div class="media mt-1 ml-3">
                                        <div class="media-body">
                                            <h6 class="m-0">Replied:</h6>
                                            <p class="mb-0 pb-0">
                                                <strong>{{$reply->user->fullname()}}: </strong>{{$reply->message}}
                                                <span class="m-0 ml-2">
                                                    {{-- Edit Btn --}}
                                                    <a class="btn btn-link p-0" href="{{route('teachercomments.edit', $reply->id)}}" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    {{-- Delete Btn --}}
                                                    <a class="btn btn-link text-danger p-0" href="{{route('teachercomments.destroy', $reply->id)}}" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </span>
                                            </p>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @endif
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
