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
        <form action="{{ route('teacher.update') }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp">
                <small id="titleHelp" class="form-text text-muted">This is the public profile name.</small>
            </div>
            <div class="form-group">
                <label for="keywords">Write Your Categories (Which subject and topics you want to teach?)</label>
                <input type="text" name="keywords" class="form-control" id="keywords">
            </div>
            <div class="form-group">
                <label for="description">Write Short description about you</label>
                <input type="text" name="description" class="form-control" id="description">
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="content">Write Full Details / Bio</label>
                    <textarea name="content" class="form-control" id="content" rows="9" aria-describedby="contentHelp"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="col form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp">
                    <small id="emailHelp" class="form-text text-muted">Choose Unique username! which is the use as your url page.</small>
                </div>
                <div class="col form-group">
                    <label for="profile_picture">Profile Picture / Logo</label>
                    <input type="file" name="profile_picture" class="form-control" id="profile_picture">
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="mobile">
                </div>
                <div class="col form-group">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" name="whatsapp" class="form-control" id="whatsapp">
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email">
                </div>
                <div class="col form-group">
                    <label for="website">Website</label>
                    <input type="text" name="website" class="form-control" id="website">
                </div>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" name="accepted" class="form-check-input" id="accept">
                <label class="form-check-label" for="accept">I Accept terms and conditions</label>
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
$('form input#profile_picture').attr('disabled', check);
$('form input#accept').attr('disabled', check);
$('form button').attr('disabled', check);

$('.edit-btn').click(function(){
    check = !check;
    $('form input, form textarea').attr('readonly', check);
    $('form input#profile_picture').attr('disabled', check);
    $('form input#accept').attr('disabled', check);
    $('form button').attr('disabled', check);
});
});
</script>
@endsection
