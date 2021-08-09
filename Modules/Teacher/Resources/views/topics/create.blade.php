@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">New Topic</div>
            <div class="col text-right">
                <a href="{{ route('teachercourses.index') }}">Back to Course List</a> |
                <a href="{{ route('teachertopics.index', ['cid' => $course_id]) }}">Topics View</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('teachertopics.store')}}" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Input Topic Title">
                        </div>
                        <div class="form-group">
                            <textarea name="details" id="editor" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cat_id">Select Course</label>
                            <select name="course_id" id="course_id" class="form-control">
                                @foreach ($courses as $course)
                                <option @if($course_id == $course->id) selected @endif value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="section">Select Secction</label>
                            <select name="section_id" id="section" class="form-control">
                                <option value="0">None</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">YouTube video Link</label>
                            <div class="form-group">
                                <textarea name="embed_code" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <div class="input-group">
                                <input type="number" id="hours" name="duration[hours]" class="form-control" placeholder="hours">
                                <input type="number" id="minutes" name="duration[minutes]" class="form-control" placeholder="minutes">
                                <input type="number" id="seconds" name="duration[seconds]" class="form-control" placeholder="seconds">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="number" id="totsec" name="duration[totsec]" readonly class="form-control" placeholder="Total Seconds">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Select Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">InActive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pstatus">Premium Status</label>
                            <select name="premium_status" id="pstatus" class="form-control">
                                <option value="free">Free</option>
                                <option value="premium">Premium</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 d-none d-sm-block">
                        <button id="talk" type="button" class="btn btn-success btn-block">
                            <i class="fa fa-microphone" aria-hidden="true"></i>
                            Voice
                        </button>
                    </div>
                    <div class="col-md-2 d-none  d-sm-block">
                        <button id="say" type="button" class="btn btn-success btn-block">
                            <i class="fa fa-volume-up" aria-hidden="true"></i>
                            Speak
                        </button>
                    </div>
                    <div class="col-md-8 col-12">
                        <input type="submit" class="btn btn-success btn-block" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@section('scripts')
<script>
window.onload = function(){
    CKEDITOR.replace('editor', {
      height: 550,
      baseFloatZIndex: 10005,
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Cut,Copy,Paste,PasteText,PasteFromWord'
    });
    getSections();
}
$('#hours, #minutes, #seconds').keyup(()=>{
    var hours = $('#hours').val();
    var minutes = $('#minutes').val();
    var seconds = $('#seconds').val();

    var totsec = (hours*3600)+(minutes*60)+(seconds*1) || '';
    $('#totsec').val(totsec);
});
$('#course_id').change(getSections);
function getSections() {
    var id = $('#course_id').val();
    var section = $('#section');
    section.empty();
    section.html('<option value="0">None</option>');
    var section_id = "{{$section_id ?? 0}}";
    $.post("{{route('teachertopics.sections')}}", {_token: '<?php echo csrf_token() ?>', cid:id}).then(function(datas) {
        console.log(datas);
        datas.forEach(data => {
            var opt = document.createElement('option');
            opt.value = data.id;
            opt.innerHTML = data.title;
            opt.selected = (data.id == section_id)? true : false;
            section.append(opt);
        });
    });
}
</script>
@endsection
