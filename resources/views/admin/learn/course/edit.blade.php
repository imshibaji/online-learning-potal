@extends('admin.learn.course.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/learn/course/list') }}" class="btn btn-primary">Course List</a>
        <a href="{{ url('/admin/learn/course/view/'. $course->id) }} " class="btn btn-warning" title="View">
            <i class="fa fa-eye" aria-hidden="true"></i>
            View
        </a>
    </div>
@endsection

@section('contentarea')
<form action="{{route('admincourseupdate')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$course->id}}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" id="title" name="title" class="form-control" placeholder="Input Course Title" value="{{$course->title}}">
                </div>
                <div class="form-group">
                    <input type="text" id="slag" name="slag" class="form-control form-control-sm" placeholder="course_title_slag" value="{{$course->slag}}">
                </div>
                <div class="form-group">
                    <textarea name="details" id="editor" class="form-control" placeholder="Main Course Content">{{$course->details}}</textarea>
                </div>
                <div class="form-group">
                    <input type="text" id="meta_keys" name="meta_keys" class="form-control" placeholder="Input Meta Keywords" value="{{$course->meta_keys}}">
                </div>
                <div class="form-group">
                    <input type="text" id="meta_desc" name="meta_desc" class="form-control" placeholder="Input Meta Description" value="{{$course->meta_desc}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Course Intro Video</label>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {{-- <x-video-uploader /> --}}
                            <x-video-selector vid="{{$course->video->id ?? null}}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Embed YouTube video</label>
                    <div class="form-group">
                        <textarea name="embed_code" class="form-control">{{$course->embed_code}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="catagory_id">Select Catagory</label>
                    <select id="catagory_id" name="catagory_id" class="form-control" >
                        <option @if($course->catagory_id==0) selected @endIf value="0">None</option>
                        @foreach ($catagories as $cat)
                            <option @if($course->catagory_id==$cat->id) selected @endIf value="{{$cat->id}}">{{$cat->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" id="duration" name="duration" class="form-control" placeholder="Input Total Course Duration" value="{{$course->duration}}">
                </div>
                <div class="form-group">
                    <label for="status">Select Satus</label>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <select name="status" class="form-control">
                                <option value="active" @if($course->status =='active') selected @endIf>Active</option>
                                <option value="inactive" @if($course->status =='inactive') selected @endIf>InActive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="accessible" class="form-control">
                                <option value="free" @if($course->accessible=='free') selected @endIf>Free</option>
                                <option value="premium" @if($course->accessible=='premium') selected @endIf>Premium</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Price</label>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" id="actual_price" name="actual_price" class="form-control"  placeholder="Actual Price" value="{{$course->actual_price}}">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="offer_price" name="offer_price" class="form-control"  placeholder="Offer Price" value="{{$course->offer_price}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Canonical URL</label>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="canonical" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" class="btn btn-success btn-block" value="Submit">
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
window.onload = function(){
    CKEDITOR.replace('editor', {
        height:420,
    });
}

$('#title').keyup(() => {
    var name = $("#title").val();
    name = name.toLowerCase();

    var slag = name.replace(/ /g, '_');
    $('#slag').val(slag);
});
</script>
@endsection
