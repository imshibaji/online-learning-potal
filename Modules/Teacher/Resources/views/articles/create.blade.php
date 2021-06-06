@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">New Article</div>
            <div class="col text-right"><a href="{{route('teacherarticles.index')}}">Back to Articles</a></div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('teacherarticles.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Input Article Title">
                        </div>
                        <div class="form-group">
                            <input type="text" id="slag" name="slag" class="form-control form-control-sm" placeholder="article_title_slag">
                        </div>
                        <div class="form-group">
                            <textarea name="details" id="editor" class="form-control" placeholder="Main Article Content"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="meta_keys" name="meta_keys" class="form-control" placeholder="Input Meta Keywords">
                        </div>
                        <div class="form-group">
                            <input type="text" id="meta_desc" name="meta_desc" class="form-control" placeholder="Input Meta Description">
                        </div>
                    </div>

                    {{-- Right Side --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="catagory_id">Select Category</label>
                            <select class="form-control" name="category_id">
                                <option value="">None</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Youtube Video URL</label>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    {{-- <x-video-uploader /> --}}
                                    {{-- <x-uploader /> --}}
                                    <textarea class="form-control" name="video" placeholder="Related YouTube Video URL"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="catagory_id">Display Image</label>
                            <x-image-uploader name="image" />
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="catagory_id">Select Status</label>
                                <select class="form-control" name="status">
                                    <option value="free">Free</option>
                                    <option value="paid">Premium</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="catagory_id">Select Type</label>
                                <select class="form-control" name="type">
                                    <option value="draft">Draft</option>
                                    <option value="publish">Publish</option>
                                    <option value="unline">Unlink</option>
                                </select>
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
    </div>
</div>
@endsection

@section('scripts')
<script>
window.onload = function(){
    CKEDITOR.replace('editor',{
        height:285
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
