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
    <ul class="list-unstyled">
        @foreach ($comments as $cmts)
        <li class="row">
            <div class="col-2">
                <h6>{{$cmts->course->title}}</h6>
                <p>{{$cmts->topic->title}}</p>
            </div>
            <div class="col-9">
              <h5 class="mt-0 mb-1">{{$cmts->title}}</h5>
              {{$cmts->message}}
            </div>
            <div class="col-1">
              <button class="btn btn-primary">Reply</button>
            </div>
        </li>
        @endforeach
        
      </ul>
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