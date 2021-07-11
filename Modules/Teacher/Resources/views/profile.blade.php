@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Tutor / Instituion Details</div>
            <div class="col text-right"><button class="btn btn-sm btn-link edit-btn">Edit</button> </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('teacher.update', $teacher->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="id" value="{{$teacher->id}}" /> --}}
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" value="{{$teacher->username}}">
                        <small id="emailHelp" class="form-text text-muted">Choose Unique username! which is the use as your url page.</small>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" value="{{$teacher->title}}">
                        <small id="titleHelp" class="form-text text-muted">This is the public profile name.</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture / Logo</label>
                        {{-- <input type="file" name="profile_picture" class="form-control" id="profile_picture"> --}}
                        <x-image-uploader name="profile_picture" id="profile_picture"
                        src="{{ ($teacher->profile_picture)? url('storage/'. $teacher->profile_picture) : url('images/image-upload.jpg')  }}" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="keywords">Write Your Categories (Which subject and topics you want to teach?)</label>
                <input type="text" name="keywords" class="form-control" id="keywords" value="{{$teacher->keywords}}">
            </div>
            <div class="form-group">
                <label for="description">Write Short description about you</label>
                <input type="text" name="description" class="form-control" id="description" value="{{$teacher->description}}">
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="content">Write Full Details / Bio</label>
                    <textarea name="content" class="form-control" id="content" rows="9" aria-describedby="contentHelp">{{$teacher->content}}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" value="{{$teacher->mobile}}">
                </div>
                <div class="col form-group">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" name="whatsapp" class="form-control" id="whatsapp" value="{{$teacher->whatsapp}}">
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{$teacher->email}}">
                </div>
                <div class="col form-group">
                    <label for="website">Website</label>
                    <input type="text" name="website" class="form-control" id="website" value="{{$teacher->website}}">
                </div>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" name="toc" class="form-check-input" id="toc">
                <label class="form-check-label" for="toc">I Accept <a href="https://larnr.com/tac">terms and conditions</a></label>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function(){
var check = true;
$('form input, form textarea').attr('readonly', check);
$('form input#image').attr('disabled', check);
$('form input#accept').attr('disabled', check);
$('form button').attr('disabled', check);

$('.edit-btn').click(function(){
    check = !check;
    $('form input, form textarea').attr('readonly', check);
    $('form input#image').attr('disabled', check);
    $('form input#accept').attr('disabled', check);
    $('form button').attr('disabled', check);
});
});
</script>
@endsection
