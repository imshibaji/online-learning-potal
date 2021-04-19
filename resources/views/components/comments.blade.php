<div class="card-body">
    @if(isset($messages) && count($messages)>0)
        <hr />
        <h4>All Comments</h4>
       @foreach ($messages as $comment)
            <div class="media my-3">
                <div class="mr-3"><x-avatar /></div>
                <div class="media-body">
                    <div>{{$comment->message}}</div>

                    @foreach ($comment->replies as $reply)
                    <div class="media mt-3">
                        <a class="mr-3" href="">
                            <div><x-avatar fl="{{$comment->user->fname}}" ll="{{$comment->user->lname}}" /></div>
                        </a>
                        <div class="media-body">
                            {{$reply->message}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>
