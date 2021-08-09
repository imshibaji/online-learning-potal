@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">New Section</div>
            <div class="col text-right">
                <a href="{{ route('teachercourses.index') }}">Back to Course List</a> |
                <a href="{{ route('teachersections.index', ['cid' => $course_id]) }}">Section List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('teachersections.store')}}" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Input Topic Title">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="editor-text" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cat_id">Select Course</label>
                            <select name="course_id" id="cat_id" class="form-control">
                                @foreach ($courses as $course)
                                <option @if($course_id == $course->id) selected @endif value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Select Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">InActive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
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
}
$('#hours, #minutes, #seconds').keyup(()=>{
    var hours = $('#hours').val();
    var minutes = $('#minutes').val();
    var seconds = $('#seconds').val();

    var totsec = (hours*3600)+(minutes*60)+(seconds*1) || '';
    $('#totsec').val(totsec);
});
</script>
@endsection
