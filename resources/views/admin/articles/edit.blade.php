@extends('admin.videos.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/article') }}" class="btn btn-primary">Article List</a>
    </div>
@endsection

@section('videocontent')
<form action="{{route('article.update', $article->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" id="title" name="title" class="form-control" placeholder="Input Video Title" value="{{ $article->title }}">
                </div>
                <div class="form-group">
                    <input type="text" id="slag" name="slag" class="form-control form-control-sm" placeholder="video_title_slag" value="{{ $article->slug }}">
                </div>
                <div class="form-group">
                    <textarea name="details" id="editor" class="form-control" placeholder="Main Video Content">{{$article->details ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <input type="text" id="meta_keys" name="meta_keys" class="form-control" placeholder="Input Meta Keywords" value="{{ $article->keywords }}">
                </div>
                <div class="form-group">
                    <input type="text" id="meta_desc" name="meta_desc" class="form-control" placeholder="Input Meta Description" value="{{ $article->description }}">
                </div>
            </div>

            {{-- Right Side --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="catagory_id">Select Category</label>
                    <select class="form-control" name="category_id">
                        <option value="">None</option>
                        @foreach ($categories as $category)
                            @if($article->category)
                                <option @if($article->category->id == $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Video *class="embed-responsive-item"</label>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea class="form-control" name="video" placeholder="Video Embed code from YouTube, Vimeo">{{$article->video_path}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="catagory_id">Display Image</label>
                    <x-image-uploader src="{{ ($article->image_path)? url('storage/'. $article->image_path) : url('images/image-upload.jpg')  }}" />
                </div>
                <div class="form-group">
                    <label for="catagory_id">Select User</label>
                    <select class="form-control" name="user_id">
                        <option value="">None</option>
                        @foreach ($users as $user)
                            @if($article->user)
                                <option @if($article->user->id == $user->id) selected @endif value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                            @else
                                <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="catagory_id">Select Status</label>
                        <select class="form-control" name="status">
                            <option value="{{$article->status}}">{{ Str::ucfirst($article->status) }}</option>
                            <option value="free">Free</option>
                            <option value="paid">Premium</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="type">Select Type</label>
                        <select class="form-control" name="type">
                            <option value="{{$article->type}}">{{ Str::ucfirst($article->type) }}</option>
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                            <option value="unline">Unlink</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="approved">Approval</label>
                    <select class="form-control" name="approved">
                        <option {{($article->approved == 0)? 'selected': ''}} value="0">Not Approved</option>
                        <option {{($article->approved == 1)? 'selected': ''}} value="1">Approved</option>
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
        height:360
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
