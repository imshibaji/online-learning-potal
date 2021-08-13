<div>
    <h5 class="mx-3 mt-3">All Comments</h5>
    <hr>
    <div class="p-3 mx-3">
        @foreach ($comments as $comment)
        <div class="media mb-3">
            {{-- <img src="/images/computer-user-icon.png" width="40" class="mr-3" alt="..."> --}}
            <div class="mr-2"><x-avatar size="50px" fl="{{$comment->user->fname}}" ll="{{$comment->user->lname}}" /></div>
            <div class="media-body">
                <p class="m-0 p-0">{{$comment->message}}
                    @if(Auth::id() == $comment->user_id)
                        <span class="m-0 ml-2">
                            {{-- Edit Btn --}}
                            <button class="btn btn-link p-0" title="Edit" onclick="edit({{$comment->id}}, '{{$comment->message}}')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            {{-- Delete Btn --}}
                            <button class="btn btn-link text-danger p-0" title="Delete" onclick="remove({{$comment->id}})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </span>
                    @endif
                </p>
                <small>{{$comment->user->fullname()}}</small>

                @isset($comment->replies)
                    @foreach ($comment->replies as $reply)
                        <div class="media mt-2">
                            <a class="mr-3" href="#">
                                {{-- <img src="/images/computer-teacher-icon.png" width="60" class="mr-3" alt="..."> --}}
                                <x-avatar fl="{{$reply->user->fname}}" ll="{{$reply->user->lname}}" />
                            </a>
                            <div class="media-body">
                                <p class="p-0 m-0">
                                    {{$reply->message}}
                                    @if(Auth::id() == $reply->user_id)
                                        <span class="m-0 ml-2">
                                            {{-- Edit Btn --}}
                                            <button class="btn btn-link p-0" title="Edit" onclick="edit({{$reply->id}}, '{{$reply->message}}')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            {{-- Delete Btn --}}
                                            <button class="btn btn-link text-danger p-0" title="Delete" onclick="remove({{$reply->id}})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </span>
                                    @endif
                                </p>
                                <small>{{$reply->user->fullname()}}</small>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-2"><button onclick="reply({{$comment->id}})" class="btn btn-outline-primary btn-sm p-1">Reply</button></div>
                @endisset
            </div>
        </div>
        @endforeach
    </div>
    <hr />
    <div class="p-3">
        <form action="{{ route('user1.topic.comment') }}" method="POST">
            @csrf
            <input type="hidden" id="tid" name="tid" value="{{$topic->id}}" />
            <input type="hidden" id="cid" name="cid" value="0" />
            <input type="hidden" id="rid" name="rid" value="0" />
            <textarea name="message" id="message" class="form-control"></textarea>
            <div class="text-right">
                <input class="btn btn-primary btn-sm" type="submit" value="Comment Now" />
            </div>
        </form>
    </div>
</div>
<script>
function edit(comment_id, comment_message) {
    $('#cid').val(comment_id);
    $('#rid').val(0);
    $('#message').val(comment_message);
}
function reply(comment_id) {
    $('#cid').val(0);
    $('#rid').val(comment_id);
    $('#message').val('');
}
function remove(id){
        if(confirm('Are you sure? Comment id: '+id)){
        $.post('{{route("user1.comment.delete")}}', { _token: '<?php echo csrf_token() ?>', cid:id}, (res)=>{
            // console.log(res);
            if(res.out){
                location.reload();
            }
        });
    }
}
</script>
