@extends('admin.videos.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/video') }}" class="btn btn-primary">Video List</a>
    </div>
@endsection

@section('videocontent')
<form action="{{route('video.update', $video->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" id="title" name="title" class="form-control" placeholder="Input Video Title" value="{{ $video->title }}">
                </div>
                <div class="form-group">
                    <input type="text" id="slag" name="slag" class="form-control form-control-sm" placeholder="video_title_slag" value="{{ $video->slug }}">
                </div>
                <div class="form-group">
                    <textarea name="details" id="editor" class="form-control" placeholder="Main Video Content">{{$video->details ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <input type="text" id="meta_keys" name="meta_keys" class="form-control" placeholder="Input Meta Keywords" value="{{ $video->keywords }}">
                </div>
                <div class="form-group">
                    <input type="text" id="meta_desc" name="meta_desc" class="form-control" placeholder="Input Meta Description" value="{{ $video->description }}">
                </div>
            </div>

            {{-- Right Side --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="catagory_id">Select Category</label>
                    <select class="form-control" name="category_id">
                        <option value="">None</option>
                        @foreach ($categories as $category)
                            @if($video->category)
                                <option @if($video->category->id == $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Video</label>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <x-video-uploader src="{{ url('storage/'. $video->video_path) }}" />
                            {{-- <x-uploader /> --}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="catagory_id">Display Image</label>
                    <x-image-uploader src="{{ url('storage/'. $video->image_path) }}" />
                </div>
                <div class="form-group">
                    <label for="catagory_id">Select User</label>
                    <select class="form-control" name="user_id">
                        <option value="">None</option>
                        @foreach ($users as $user)
                            @if($video->user)
                                <option @if($video->user->id == $user->id) selected @endif value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                            @else
                                <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="catagory_id">Select User</label>
                        <select class="form-control" name="status">
                            <option value="{{$video->status}}">{{ Str::ucfirst($video->status) }}</option>
                            <option value="free">Free</option>
                            <option value="paid">Premium</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="catagory_id">Select Type</label>
                        <select class="form-control" name="type">
                            <option value="{{$video->type}}">{{ Str::ucfirst($video->type) }}</option>
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                            <option value="unline">Unlink</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="approved">Approval</label>
                    <select class="form-control" name="approved">
                        <option {{($video->approved == 0)? 'selected': ''}} value="0">Not Approved</option>
                        <option {{($video->approved == 1)? 'selected': ''}} value="1">Approved</option>
                    </select>
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
    CKEDITOR.replace('editor',{
        height:500
    });
}

$('#title').keyup(() => {
    var name = $("#title").val();
    name = name.toLowerCase();

    var slag = name.replace(/ /g, '-');
    $('#slag').val(slag);
});
</script>
@endsection
