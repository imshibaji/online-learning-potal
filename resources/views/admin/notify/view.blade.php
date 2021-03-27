@extends('admin.notify.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{url('/')}}/admin/notify/list" class="btn btn-primary">Notifications</a>
    </div>
@endsection

@section('usercontent')
    <h1>User Content</h1>
@endsection