@extends('admin.users.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/user/list') }}" class="btn btn-primary">User List</a>
    </div>
@endsection

@section('usercontent')   
<div class="container">
  <form action="{{route('adminuserupdate')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$user->id}}">
        <div class="row">
            <div class="col form-group">
              <label for="email">Email address</label>
              <input type="email" name="email" class="form-control" id="email" aria-describedby="email" readonly value="{{$user->email}}">
              <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="col form-group">
              <label for="password">New Password</label>
              <input type="password" name="new_password" class="form-control" id="password">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col form-group">
              <label for="fname">First Name</label>
              <input type="text" name="fname" class="form-control" id="fname" value="{{$user->fname}}">
            </div>
            <div class="col form-group">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" class="form-control" id="lname" value="{{$user->lname}}">
            </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="dob">Date Of Birth</label>
            <input type="date" name="dob" class="form-control" id="dob" value="{{$user->dob}}">
          </div>
          <div class="col form-group">
            <label for="prof">Profession</label>
            <input type="text" name="profession" class="form-control" id="prof" value="{{$user->profession}}">
          </div>
        </div>
        <div class="form-group">
          <label for="orgname"><i class="fa fa-building" aria-hidden="true"></i> Company / College Name</label>
          <input type="text" name="orgname" class="form-control" id="orgname" value="{{$user->orgname}}">
        </div>
        <div class="row">
            <div class="col form-group">
              <label for="mobile"><i class="fa fa-mobile" aria-hidden="true"></i> Mobile</label>
              <input type="text" name="mobile" class="form-control" id="mobile" value="{{$user->mobile}}">
            </div>
            <div class="col form-group">
              <label for="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</label>
              <input type="text" name="whatsapp" class="form-control" id="whatsapp" value="{{$user->whatsapp}}">
            </div>
        </div>
        <div class="form-group">
          <label for="address"><i class="fa fa-address-book" aria-hidden="true"></i> Address</label>
          <input type="text" name="address" class="form-control" id="address" value="{{$user->address}}">
        </div>
        <div class="row">
            <div class="col form-group">
              <label for="city">City</label>
              <input type="text" name="city" class="form-control" id="city" value="{{$user->city}}">
            </div>
            <div class="col form-group">
              <label for="pincode">Pincode</label>
              <input type="text" name="pincode" class="form-control" id="pincode" value="{{$user->pincode}}">
            </div>
        </div>
        <div class="row">
            <div class="col form-group">
              <label for="state">State</label>
              <input type="text" name="state" class="form-control" id="state" value="{{$user->state}}">
            </div>
            <div class="col form-group">
              <label for="country">Country</label>
              <input type="text" name="country" class="form-control" id="country" value="{{$user->country}}">
            </div>
        </div>
        <div class="row">
            <div class="col form-group">
              <label for="utype">User Type</label>
              <select name="user_type" class="form-control" id="utype">
                <option value="user" @if($user->user_type == 'user') selected @endif>User</option>
                <option value="stuff" @if($user->user_type == 'stuff') selected @endif>Stuff</option>
                @utype('admin')
                  <option value="admin" @if($user->user_type == 'admin') selected @endif>Admin</option>
                @endutype
              </select>
            </div>
            <div class="col form-group">
              <label for="status">Status</label>
              <select name="active" class="form-control" id="active">
                <option value="1" @if($user->active == 1) selected @endif>Active</option>
                <option value="0" @if($user->active == 0) selected @endif>InActive</option>
              </select>
            </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="utype">Reffer By</label>
            <select name="reffer_by_user_id" class="form-control" id="utype">
              <option value="0">None</option>
              @foreach ($users as $u)
                <option value="{{$u->id}}" @if($u->id == $user->reffer_by_user_id) selected @endif>{{$u->fname}} {{$u->lname}}</option>
              @endforeach
            </select>
          </div>
          <div class="col form-group">
            <label for="status">Managed By</label>
            <select name="manage_by_user_id" class="form-control" id="active">
              <option value="0">None</option>
              @foreach ($users as $u)
                @if($u->user_type == 'stuff')
                  <option value="{{$u->id}}" @if($u->id == $user->manage_by_user_id) selected @endif>{{$u->fname}} {{$u->lname}}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection