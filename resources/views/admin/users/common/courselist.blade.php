<div class="accordion" id="courses">
    @foreach ($courses as $k => $course)
    <div class="card">
        <div class="card-header" id="heading{{ $course->id }}">
            <h2 class="mb-0 row">
                <div class="col">
                    <button class="btn btn-link" type="button" data-toggle="collapse" aria-expanded="true" data-target="#collapse{{ $course->id }}" aria-controls="collapse{{ $course->id }}">
                        {{ $course->title }}
                    </button>

                    @forelse ($user->courseAssignments as $ca)
                        @if($ca->course_id == $course->id)
                            <span class="badge badge-success"><i class="fa fa-check"></i></span>
                        @endif
                    @empty
                        <span class="badge badge-info"><i class="fa fa-close"></i></span>
                    @endforelse
                </div>
                <div class="col text-right">
                    <button onclick="courseAssign('{{$user->id}}', '{{$course->id}}')" class="btn text-success btn-link btn-sm">
                        Assign
                    </button>
                    <button onclick="courseUnAssign('{{$user->id}}', '{{$course->id}}')" class="btn text-danger btn-link btn-sm">
                        UnAssign
                    </button>
                </div>
            </h2>
        </div>
    
        <div id="collapse{{ $course->id }}" class="collapse" aria-labelledby="heading{{ $course->id }}" data-parent="#courses">
            <div class="card-body">
                    @foreach ($course->topics as $topic)
                        @if($topic->status == 'active')
                        <div class="list-group list-group-item list-group-item-action">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn btn-link">
                                        {{ $topic->title}}
                                    </a>
                                    @forelse ($user->topicAssignments as $ta)
                                        @if($ta->topic_id == $topic->id)
                                            <span class="badge badge-success"><i class="fa fa-check"></i> Assigned</span>
                                        @endif  
                                    @empty
                                        <span class="badge badge-info">Not Assigned</span>
                                    @endforelse
                                    

                                    {{-- <span class="badge badge-primary">Not Assigned</span>
                                    <span class="badge badge-secondary">2 Comments</span>
                                    <span class="badge badge-warning">Answered</span> --}}
                                </div> 
                                <div class="col text-right">
                                    <button onclick="topicAssign('{{$user->id}}', '{{$course->id}}', '{{$topic->id}}')" class="btn btn-outline-success btn-sm">
                                        Assign
                                    </button>
                                    <button onclick="topicUnAssign('{{$user->id}}', '{{$course->id}}', '{{$topic->id}}')" class="btn btn-outline-danger btn-sm">
                                        UnAssign
                                    </button>
                                    {{-- <button class="btn btn-outline-info btn-sm">
                                        Tasks / Answers
                                    </button>
                                    <button class="btn btn-outline-dark btn-sm">
                                        Comments
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>


@section('scripts')
<script>
function courseAssign(uid, cid){
    $.get('{{url("/")}}/admin/assign/course?cid='+cid+'&uid='+uid).then(function(){
        window.location.reload();
    });
}
function courseUnAssign(uid, cid){
    $.get('{{url("/")}}/admin/assign/courseunset?cid='+cid+'&uid='+uid).then(function(){
        window.location.reload();
    });
}
function topicAssign(uid, cid, tid){
    $.get('{{url("/")}}/admin/assign/topic?cid='+cid+'&uid='+uid+'&tid='+tid).then(function(){
        window.location.reload();
    });
}

function topicUnAssign(uid, cid, tid){
    $.get('{{url("/")}}/admin/assign/topicunset?cid='+cid+'&uid='+uid+'&tid='+tid).then(function(){
        window.location.reload();
    });
}
</script>
@endsection