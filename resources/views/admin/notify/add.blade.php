@extends('admin.notify.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{url('/')}}/admin/notify/list" class="btn btn-primary"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</a>
    </div>
@endsection


@section('usercontent')
<form action="{{route('adminnotifycreate')}}" method="POST">
    @csrf
    <input type="hidden" name="uid" value="{{ Auth::id() }}">
<div class="row">
    <div class="col-md-8">
        <div class="mb-2"><input type="text" class="form-control form-control-lg" name="title" placeholder="Input Title" required></div>
        <div class="form-group">
            <strong>Users Macro ShortCode</strong>
            <div>[fname], [lname], [email], 
                [mobile], [whatsapp], [profession], [orgname], 
                [whatsapp], [address], [city], [pincode], 
                [state], [country]
            </div>
        </div>
        <div class="mt-2"><textarea id="editor" class="form-control" name="details" placeholder="Input Detail Message"></textarea></div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="sending_time">Sending DateTime</label>
            <div class="form-group row">
               <div class="col-md-6"><input type="date" name="sending_date" class="form-control" id="sending_time"></div>
               <div class="col-md-6"><input type="time" name="sending_time" class="form-control" id="sending_time"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="expaire_at">Expaire DateTime</label>
            <div class="form-group row">
                <div class="col-md-6"><input type="date" name="expaire_date" class="form-control" id="expaire_at"></div>
                <div class="col-md-6"><input type="time" name="expaire_time" class="form-control" id="expaire_at"></div>
             </div>
        </div>
        <div class="form-group">
            <label for="sending_status">Sending Status</label>
            <select name="sending_status" class="form-control" id="sending_status" disabled>
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="notify_type">Notify Type</label>
            <select name="notify_type" class="form-control" id="notify_type">
                <option value="all">All</option>
                <option value="sms">SMS</option>
                <option value="email">Email</option>
                <option value="whatsapp">WhatsApp</option>
                <option value="dashboard">User Dashboard</option>
            </select>
        </div>
        <div class="form-group">
            <label for="premium_type">Premium Type</label>
            <select name="premium_type" class="form-control" id="premium_type">
                <option value="none">None</option>
                <option value="silver">Silver</option>
                <option value="gold">Gold</option>
                <option value="platinum">Platinum</option>
            </select>
        </div>
        <div class="form-group">
            <label for="user_type">User Type</label>
            <select name="user_type" class="form-control" id="user_type">
                <option value="all">All</option>
                <option value="user">User</option>
                <option value="stuff">Stuff</option>
                <option value="Admin">Admin</option>
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
    var date= moment();
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
    var next = moment().add(7, 'days');
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