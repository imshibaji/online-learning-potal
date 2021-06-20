@extends('admin.learn.course.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/learn/course/list') }}" class="btn btn-primary">Course List</a>
    </div>
@endsection

@section('contentarea')
<form action="{{route('admincoursecreate')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" id="title" name="title" class="form-control" placeholder="Input Course Title">
                </div>
                <div class="form-group">
                    <input type="text" id="slag" name="slag" class="form-control form-control-sm" placeholder="course_title_slag">
                </div>
                <div class="form-group">
                    <textarea name="details" id="editor" class="form-control" placeholder="Main Course Content"></textarea>
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
                    <label for="status">YouTube video Link</label>
                    <div class="form-group">
                        <textarea name="embed_code" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="catagory_id">Display Image</label>
                    <x-image-uploader name="image" />
                </div>
                <div class="form-group">
                    <label for="catagory_id">Select Catagory</label>
                    <select id="catagory_id" name="catagory_id" class="form-control" >
                        <option value="0">None</option>
                        @foreach ($catagories as $cat)
                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" id="duration" name="duration" class="form-control" placeholder="Input Total Course Duration">
                </div>
                <div class="form-group">
                    <label for="status">Select Satus</label>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">InActive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="accessible" class="form-control">
                                <option value="free">Free</option>
                                <option value="premium">Premium</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" id="mode" name="mode" class="form-control" placeholder="Training Mode">
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="session_time" name="session_time" class="form-control" placeholder="Session Start Time">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Price</label>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" id="actual_price" name="actual_price" class="form-control"  placeholder="Actual Price">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="offer_price" name="offer_price" class="form-control"  placeholder="Offer Price">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Canonical URL</label>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="canonical" placeholder="URL Link" />
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
    CKEDITOR.replace('editor',{
        height:480
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
