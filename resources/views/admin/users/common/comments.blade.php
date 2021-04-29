<form action="{{ route('admincommentnew') }}" method="POST">
@csrf
<input type="hidden" name="user_id" value="{{ $user->id }}">
<div class="row p-2">
    <div class="col">
        <input name="title" class="form-control" placeholder="Input Your Comment Title">
    </div>
</div>
<div class="row p-2">
    <div class="col">
        <textarea name="message" class="form-control" placeholder="Input Your Comment Details"></textarea>
    </div>
</div>
<div class="row p-2">
    <div class="col">
        <select id="cid" name="course_id" class="form-control input-sm">
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{$course->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <select id="tid" name="topic_id" class="form-control input-sm">
            <option value="0">None</option>
        </select>
    </div>
</div>
<div class="row p-2">
    <button class="btn btn-success btn-block">Submit</button>
</div>
</form>


<div>
    <hr/>
    <div class="container">
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

@section('scripts2')
<script>
$('#cid').change(function(){
    getTopics();
});
getTopics();
function getTopics(){
    var cid = $('#cid').val();
    $.get("{{url('/')}}/admin/learn/question/topic/"+cid).then((data)=>{
        $('#tid').empty();
        data.forEach(el => {
            $('#tid').append(`<option value="${el.id}">${el.title}</option>`);
        });
    });
}
</script>
@endsection
