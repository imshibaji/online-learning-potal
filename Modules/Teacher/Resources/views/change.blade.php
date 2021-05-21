@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">Change Password</div>
    <div class="card-body">
        @php
            $user = Auth::user();
        @endphp
        <form action="{{ route('changePassword') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label>Email Address</label>
                    <input type="text" name="email" class="form-control" value="{{$user->email}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Current Password</label>
                    <input type="password" name="current-password" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>New Password</label>
                    <input type="password" name="new-password" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Confirm Password</label>
                    <input type="text" name="confirm-password" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col pt-3">
                    <input type="submit" class="btn btn-success btn-block" value="Change Password">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
