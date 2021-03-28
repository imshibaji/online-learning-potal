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
            </div>

            {{-- Right Side --}}
            <div class="col-md-4">
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
                    <input type="text" id="meta_keys" name="meta_keys" class="form-control" placeholder="Input Meta Keywords" value="{{ $video->keywords }}">
                </div>
                <div class="form-group">
                    <input type="text" id="meta_desc" name="meta_desc" class="form-control" placeholder="Input Meta Description" value="{{ $video->description }}">
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
        height:400
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
