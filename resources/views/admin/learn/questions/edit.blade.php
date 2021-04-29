@extends('admin.learn.questions.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/learn/question/list') }}" class="btn btn-primary">Question List</a>
        @if(isset($topic_id))
            <a href="{{ url('admin/learn/topic/view/'.$topic_id) }}" class="btn btn-warning">Back To Topic</a>
        @endif
    </div>
@endsection

@section('contentarea')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
        <form action="{{route('adminquestionupdate')}}" method="POST">
            @csrf
            <input type="hidden" name="qid" value="{{ $question->id }}">
            <table class="table">
                <tr>
                    <td>Course Name</td>
                    <td>
                        <select id="cid" name="course_id" class="form-control">
                            @foreach ($courses as $course)
                                @if($question->topic->course->id == $course->id)
                                    <option value="{{$course->id}}" selected>{{$course->title}}</option>
                                @else
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Topic Name</td>
                    <td>
                        <select id="tid" name="topic_id" class="form-control">
                            <option value="0">None</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Question</td>
                    <td><textarea name="question" id="editor" class="form-control">{{ $question->question }}</textarea></td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td>
                        <select name="qtype" id="qtype" class="form-control">
                            <option value="1">Single Choice</option>
                            <option value="2">Multiple Choice</option>
                            <option value="3">Answered</option>
                        </select>
                    </td>
                </tr>
                <tr id="options">
                    <td>Answer Options</td>
                    <td>
                        <div id="opt_area">
                        @php
                            $opts = json_decode($question->opt, true);
                           //  var_dump($opts);
                        @endphp
                        @foreach ($opts as $key => $opt)
                            <div class="input-group py-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" class="ans" name="ans[]" value="{{$key+1}}">
                                    </div>
                                </div>
                                <input type="text" name="opt[]" class="form-control" value="{{ $opt }}" />
                                <div class="input-group-append">
                                    <input type="button" class="input-group-text text-danger" name="close" value="X">
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="input-group py-2">
                            <button id="addOpt" class="btn btn-info">Add New Option</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Correct Answer</td>
                    <td>
                        <textarea id="answer" class="form-control" name="answer" placeholder="Input The Correct Answer">{{$question->answer}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Marks</td>
                    <td class="row">
                        <div class="col">
                            <input type="number" name="design_points" class="form-control" placeholder="Design Points" value="{{ $question->design_points }}" />
                        </div>
                        <div class="col">
                            <input type="number" name="development_points" class="form-control" placeholder="Development Points" value="{{ $question->development_points }}" />
                        </div>
                        <div class="col">
                            <input type="number" name="debugging_points" class="form-control" placeholder="Debugging Points" value="{{ $question->debugging_points }}" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Duration</td>
                    <td class="row">
                        @php
                            $dur = json_decode($question->duration, true);
                        @endphp
                        <div class="col">
                            <input type="number" id="hours" name="duration[hours]" class="form-control" placeholder="hours" value="{{ $dur['hours'] }}">
                        </div>
                        <div class="col">
                            <input type="number" id="minutes" name="duration[minutes]" class="form-control" placeholder="minutes" value="{{ $dur['minutes'] }}">
                        </div>
                        <div class="col">
                            <input type="number" id="seconds" name="duration[seconds]" class="form-control" placeholder="seconds" value="{{ $dur['seconds'] }}">
                        </div>
                        <div class="col">
                            <input type="number" id="totsec" name="duration[totsec]" readonly class="form-control" placeholder="total seconds" value="{{ $dur['totsec'] }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" class="form-control">
                            <option value="active" @if($question->status=='active') selected @endIf>Active</option>
                            <option value="inactive" @if($question->status=='inactive') selected @endIf>InActive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" class="btn btn-success" value="Submit"></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.onload = function(){
    CKEDITOR.replace('editor');
    CKEDITOR.replace('answer');
}
$('#hours, #minutes, #seconds').keyup(()=>{
    var hours = $('#hours').val();
    var minutes = $('#minutes').val();
    var seconds = $('#seconds').val();

    var totsec = (hours*3600)+(minutes*60)+(seconds*1) || '';
    $('#totsec').val(totsec);
});

$('#cid').change(function(){
    getTopics();
});
getTopics();
function getTopics(){
    var cid = $('#cid').val();
    $.get("{{url('/')}}/admin/learn/question/topic/"+cid).then((data)=>{
        $('#tid').empty();
        data.forEach(el => {
            var tid = '{{ $question->topic_id }}';
            if(el.id == tid){
                $('#tid').append(`<option value="${el.id}" selected>${el.title}</option>`);
            }else{
                $('#tid').append(`<option value="${el.id}">${el.title}</option>`);
            }
        });
    });
}


$('#qtype').val('{{$question->qtype}}');
$('#options').show();
$('#qtype').change(() => {
    qType();
});
qType();
function qType(){
    const type = $('#qtype').val();
    // console.log(type);
    if(type == 1){
        $('#options').show();
        $('.ans').each(function(){
            $(this).attr('type', 'radio');
        });
    }

    else if(type == 2){
        $('#options').show();
        $('.ans').each(function(){
            $(this).attr('type', 'checkbox');
        });
    }
    else if(type == 3){
        $('#options').hide();
    }
}


var ansArr = {!! $question->ans !!};
selectAns();
function selectAns(){
    $('input[name="ans[]"]').each(function(){
        ansArr.forEach(el=>{
            if(el==$(this).val()){
                $(this).attr('checked', 'true');
            }
        })
    });
}

var oval = "{{ count($opts) }}";
$('#addOpt').click(function(e){
    e.preventDefault();
    oval++;

    const type = $('#qtype').val();

    if(type == 1){
        $('#opt_area').append(`
        <div class="input-group py-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" class="ans" name="ans[]" value="${oval}">
                </div>
            </div>
            <input type="text" name="opt[]" class="form-control" placeholder="Option ${oval}" />
            <div class="input-group-append">
                <input type="button" class="input-group-text text-danger" name="close" value="X">
            </div>
        </div>
        `);
    }else if(type == 2){
        $('#opt_area').append(`
        <div class="input-group py-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" class="ans" name="ans[]" value="${oval}">
                </div>
            </div>
            <input type="text" name="opt[]" class="form-control" placeholder="Option ${oval}" />
            <div class="input-group-append">
                <input type="button" class="input-group-text text-danger" name="close" value="X">
            </div>
        </div>
        `);
    }
    reload();
});

reload();
function reload(){
    $('input[name="close"]').each(function(){
        $(this).click(function(){
            $(this).parent().parent().remove();
        });
        // console.log($(this).parent().parent());
    });
}
</script>
@endsection
