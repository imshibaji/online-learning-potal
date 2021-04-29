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
            <form action="{{route('adminquestioncreate')}}" method="POST">
                @csrf
                <table class="table">
                    <tr>
                        <td>Course Name</td>
                        <td>
                            <select id="cid" name="course_id" class="form-control">
                                @foreach ($courses as $course)
                                    <option @if($course_id == $course->id) selected @endif value="{{$course->id}}">{{$course->title}}</option>
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
                        <td><textarea name="question" id="editor" class="form-control"></textarea></td>
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
                            <div class="input-group py-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      <input type="radio" class="ans" name="ans[]" value="1">
                                    </div>
                                </div>
                                <input type="text" name="opt[]" class="form-control" placeholder="Option 1" />
                                <div class="input-group-append">
                                    <input type="button" class="input-group-text text-danger" name="close" value="X">
                                </div>
                            </div>
                            <div class="input-group py-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      <input type="radio" class="ans" name="ans[]" value="2">
                                    </div>
                                </div>
                                <input type="text" name="opt[]" class="form-control" placeholder="Option 2" />
                                <div class="input-group-append">
                                    <input type="button" class="input-group-text text-danger" name="close" value="X">
                                </div>
                            </div>
                            </div>
                            <div class="input-group py-2">
                                <button id="addOpt" class="btn btn-info">Add New Option</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Correct Answer</td>
                        <td>
                            <textarea id="answer" class="form-control" name="answer" placeholder="Input The Correct Answer"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Marks</td>
                        <td class="row">
                            <div class="col">
                                <input type="number" name="design_points" class="form-control" placeholder="Design Points" />
                            </div>
                            <div class="col">
                                <input type="number" name="development_points" class="form-control" placeholder="Development Points" />
                            </div>
                            <div class="col">
                                <input type="number" name="debugging_points" class="form-control" placeholder="Debugging Points" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Duration</td>
                        <td class="row">
                            <div class="col">
                                <input type="number" id="hours" name="duration[hours]" class="form-control" placeholder="hours">
                            </div>
                            <div class="col">
                                <input type="number" id="minutes" name="duration[minutes]" class="form-control" placeholder="minutes">
                            </div>
                            <div class="col">
                                <input type="number" id="seconds" name="duration[seconds]" class="form-control" placeholder="seconds">
                            </div>
                            <div class="col">
                                <input type="number" id="totsec" name="duration[totsec]" readonly class="form-control" placeholder="total seconds">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">InActive</option>
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
var tid = {!! $topic_id !!};
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
            var elm = (el.id == tid)? `<option selected value="${el.id}">${el.title}</option>` : `<option value="${el.id}">${el.title}</option>`;
            $('#tid').append(elm);
        });
    });
}


$('#options').show();
$('#qtype').change(() => {
    const type = $('#qtype').val();
    console.log(type);
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
});

var oval = 2;
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
