@extends('admin.users.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/user/list') }}" class="btn btn-primary">User List</a>
    </div>
@endsection

@section('usercontent')   
<div class="container">
  <form action="{{route('adminusercreate')}}" method="POST">
    @csrf
        <div class="row">
            <div class="col form-group">
              <label for="email">Email address</label>
              <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
              <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="col form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control" id="fname">
          </div>
          <div class="col form-group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" id="lname">
          </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="dob">Date Of Birth</label>
            <input type="date" name="dob" class="form-control" id="dob">
          </div>
          <div class="col form-group">
            <label for="prof">Profession</label>
            <input type="text" name="profession" class="form-control" id="prof">
          </div>
        </div>
        <div class="form-group">
          <label for="orgname"><i class="fa fa-building" aria-hidden="true"></i> Company / College Name</label>
          <input type="text" name="orgname" class="form-control" id="orgname">
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="mobile"><i class="fa fa-mobile" aria-hidden="true"></i> Mobile</label>
            <input type="text" name="mobile" class="form-control" id="mobile">
          </div>
          <div class="col form-group">
            <label for="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</label>
            <input type="text" name="whatsapp" class="form-control" id="WhatsApp">
          </div>
        </div>
        <div class="form-group">
          <label for="address"><i class="fa fa-address-card" aria-hidden="true"></i> Address</label>
          <input type="text" name="address" class="form-control" id="address">
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="city"><i class="fa fa-circle-thin" aria-hidden="true"></i> City</label>
            <input type="text" name="city" class="form-control" id="city">
          </div>
          <div class="col form-group">
            <label for="pincode">Pincode</label>
            <input type="text" name="pincode" class="form-control" id="pincode">
          </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="state">State</label>
            <input type="text" name="state" class="form-control" id="state">
          </div>
          <div class="col form-group">
            <label for="country">Country</label>
            <input type="text" name="country" class="form-control" id="country">
          </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="utype">User Type</label>
            <select name="user_type" class="form-control" id="utype">
              <option value="user">User</option>
              <option value="stuff">Stuff</option>
              @utype('admin')
                <option value="admin">Admin</option>
              @endutype
            </select>
          </div>
          <div class="col form-group">
            <label for="status">Status</label>
            <select name="active" class="form-control" id="active">
              <option value="1">Active</option>
              <option value="0">InActive</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for="reffer_by_user_id">Reffer By</label>
            <select name="reffer_by_user_id" class="form-control" id="reffer_by_user_id">
              <option value="0">None</option>
              @foreach ($users as $u)
                <option value="{{$u->id}}">{{$u->fname}} {{$u->lname}}</option>
              @endforeach
            </select>
          </div>
          <div class="col form-group">
            <label for="manage_by_user_id">Managed By</label>
            <select name="manage_by_user_id" class="form-control" id="manage_by_user_id">
              <option value="0">None</option>
              @foreach ($users as $u)
                @if($u->user_type == 'stuff')
                  <option value="{{$u->id}}">{{$u->fname}} {{$u->lname}}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection
