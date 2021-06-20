<div class="card">
    <div class="card-header">Comments</div>
    <div class="card-body" style="min-height: 240px;">
    @foreach ($comments as $cmt)
        <div class="media">
            @if($cmt->commentable)
            <img src="{{ url('storage/'.$cmt->commentable->image_path)}}" class="mr-3" width="60px" alt="{{$cmt->commentable->title}}">
            <div class="media-body">
                <h5 class="m-0"><span class="text-success">{{$cmt->commentable->title}}</span></h5>
                <p class="p-0 m-0"><strong>{{$cmt->user->fullname()}}: </strong> {{$cmt->message}}</p>
                <p class="p-0 m-0 ml-3 mb-1"></p>
            </div>
            @endif
        </div>
    @endforeach
    </div>
</div>
