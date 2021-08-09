@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Course: {{$topic->course->title}}</div>
            <div class="col text-right">
                <a href="{{ route('teachercourses.index') }}">Back to Course List</a> |
                <a href="{{ route('teachersections.show', $topic->section->id) }}">Section View</a> |
                <a href="{{ route('teachertopics.index', ['cid' => $course_id]) }}">All Topics</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('teachertopics.update', $topic->id )}}" method="POST">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="tid" class="form-control" value="{{ $topic->id }}"> --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Input Topic Title" value="{{ $topic->title }}">
                        </div>
                        <div class="form-group">
                            <textarea name="details" id="editor" class="form-control">{{ $topic->details }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cat_id">Select Catagory</label>
                            <select name="course_id" id="course_id" class="form-control">
                                @foreach ($courses as $course)
                                    <option value="{{$course->id}}" @if($course->id === $topic->course->id) selected @endif>{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="section">Select Secction</label>
                            <select name="section_id" id="section" class="form-control">
                                <option value="0">None</option>
                            </select>
                        </div>
                        @if($topic->video || $topic->embed_code)
                            <div class="form-group">
                                <label for="video">Video Preview</label>
                                {{-- <x-video-uploader name="embed_code" src="{{ $topic->embed_code }}" /> --}}
                                {{-- <x-video-selector vid="{{$topic->video->id ?? null }}" /> --}}
                                @isset($topic->video->video_path)
                                    <x-video-selector vid="{{$topic->video->id ?? null}}" />
                                    {{-- <x-video src="{{url('storage/'.$course->video->video_path)}}" poster="{{ url('storage/'.$course->video->image_path ) }}" /> --}}
                                @endisset
                                @isset($topic->embed_code)
                                    <x-video src="{{$topic->embed_code}}" type="video/youtube" poster="{{ $topic->image_path? url('storage/'.$topic->image_path ) : null }}" />
                                @endisset
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="status">YouTube video Link</label>
                            <div class="form-group">
                                <textarea name="embed_code" class="form-control">{{$topic->embed_code}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            @php
                                $dur = json_decode($topic->duration, true);
                            @endphp
                            <div class="input-group">
                                <input type="number" id="hours" name="duration[hours]" class="form-control" placeholder="hours" value="{{ $dur['hours'] }}">
                                <input type="number" id="minutes" name="duration[minutes]" class="form-control" placeholder="minutes" value="{{ $dur['minutes'] }}">
                                <input type="number" id="seconds" name="duration[seconds]" class="form-control" placeholder="seconds" value="{{ $dur['seconds'] }}">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="number" id="totsec" name="duration[totsec]" readonly class="form-control" placeholder="Total Seconds" value="{{ $dur['totsec'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active" @if($topic->status == 'active') selected @endIf>Active</option>
                                    <option value="inactive" @if($topic->status == 'inactive') selected @endIf>InActive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="pstatus">Premium</label>
                                <select name="premium_status" id="pstatus" class="form-control">
                                    <option value="free" @if($topic->premium_status == 'free') selected @endIf>Free</option>
                                    <option value="premium" @if($topic->premium_status == 'premium') selected @endIf>Premium</option>
                                </select>
                            </div>
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
    var section_id = "{{$topic->section->id ?? 0}}";
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
