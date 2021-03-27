@extends('admin.notify.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{url('/')}}/admin/notify/list" class="btn btn-primary"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</a>
    </div>
@endsection


@section('usercontent')
<form action="{{route('adminnotifyupdate')}}" method="POST">
    @csrf
    <input type="hidden" name="nid" value="{{$notify->id}}">
    <input type="hidden" name="uid" value="{{ Auth::id() }}">
<div class="row">
    <div class="col-md-8">
    <div class="mb-2"><input type="text" class="form-control form-control-lg" name="title" placeholder="Input Title" value="{{$notify->title}}"></div>
        <div class="form-group">
            <strong>Users Macro ShortCode</strong>
            <div>[fname], [lname], [email], 
                [mobile], [whatsapp], [profession], [orgname], 
                [whatsapp], [address], [city], [pincode], 
                [state], [country]
            </div>
        </div>
        <div class="mt-2"><textarea id="editor" class="form-control" name="details" placeholder="Input Detail Message">{{$notify->details}}</textarea></div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="sending_time">Sending DateTime</label>
            <div class="form-group row">
               <div class="col-md-7"><input type="date" name="sending_date" class="form-control" id="sending_time"></div>
               <div class="col-md-5"><input type="time" name="sending_time" class="form-control" id="sending_time"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="expaire_at">Expaire DateTime</label>
            <div class="form-group row">
                <div class="col-md-7"><input type="date" name="expaire_date" class="form-control" id="expaire_at"></div>
                <div class="col-md-5"><input type="time" name="expaire_time" class="form-control" id="expaire_at"></div>
             </div>
        </div>
        <div class="form-group">
            <label for="sending_status">Sending Status</label>
            <select name="sending_status" class="form-control" id="sending_status">
                <option @if($notify->sending_status == 'no') selected @endif value="no">No</option>
                <option @if($notify->sending_status == 'yes') selected @endif value="yes">Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="notify_type">Notify Type</label>
            <select name="notify_type" class="form-control" id="notify_type">
                <option value="all" @if($notify->notify_type == 'all') selected @endif>All</option>
                <option value="sms" @if($notify->notify_type == 'sms') selected @endif>SMS</option>
                <option value="email" @if($notify->notify_type == 'email') selected @endif>Email</option>
                <option value="whatsapp" @if($notify->notify_type == 'whatsapp') selected @endif>WhatsApp</option>
                <option value="dashboard" @if($notify->notify_type == 'dashboard') selected @endif>User Dashboard</option>
            </select>
        </div>
        <div class="form-group">
            <label for="premium_type">Premium Type</label>
            <select name="premium_type" class="form-control" id="premium_type">
                <option value="none" @if($notify->premium_type == 'none') selected @endif>None</option>
                <option value="silver" @if($notify->premium_type == 'silver') selected @endif>Silver</option>
                <option value="gold" @if($notify->premium_type == 'gold') selected @endif>Gold</option>
                <option value="platinum" @if($notify->premium_type == 'platinum') selected @endif>Platinum</option>
            </select>
        </div>
        <div class="form-group">
            <label for="user_type">User Type</label>
            <select name="user_type" class="form-control" id="user_type">
                <option value="all" @if($notify->user_type == 'all') selected @endif>All</option>
                <option value="user" @if($notify->user_type == 'user') selected @endif>User</option>
                <option value="stuff" @if($notify->user_type == 'stuff') selected @endif>Stuff</option>
                <option value="admin" @if($notify->user_type == 'admin') selected @endif>Admin</option>
            </select>
        </div>

        <div class="btn-group text-center">
            <input type="submit" class="btn btn-success">
            <input type="reset" class="btn btn-warning">
        </div>
    </div>
</div>
</form>
@endsection


@section('scripts')
<script src="{{url('/')}}/js/moment.min.js"></script>
<script>
window.onload = function(){
    CKEDITOR.replace('editor', {
        height: 300
    });

    dateTimeSetup();
}

function dateTimeSetup(){

    // Sending At
    var date= moment('{{ $notify->sending_time }}');
    var day = date.date();
    day = (day < 10)? '0'+day : day;
    var month = date.month()+1;
    month = (month < 10)? '0'+month : month;
    var year = date.year();
    var today = year+'-'+month+'-'+day;
    var hrs = date.hour();
    hrs = (hrs<10)? '0'+hrs : hrs;
    var minu = date.minute();
    minu = (minu < 10)? '0'+minu : minu;
    var time = hrs+':'+minu;
    $('input[type="date"]').val(today);
    $('input[type="time"]').val(time);


    // Expaire At
    var next = moment('{{$notify->expaire_at}}');
    var day = next.date();
    day = (day < 10)? '0'+day : day;
    var month = next.month()+1;
    month = (month < 10)? '0'+month : month;
    var year = next.year();
    var nextDate = year+'-'+month+'-'+day;
    $('input#expaire_at[type="date"]').val(nextDate);

}
</script>
@endsection