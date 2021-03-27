@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile Information</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @php
                        $user = Auth::user();
                    @endphp
                <form action="{{ route('profilePost') }}" method="POST">
                    @csrf
                    <input type="hidden" name="uid" value="{{$user->id}}" />
                    <input type="hidden" name="email" value="{{$user->email}}" />
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label>First Name</label>
                                    <input type="text" name="fname" class="form-control" value="{{$user->fname}}">
                                </div>
                                <div class="col">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" class="form-control" value="{{$user->lname}}">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label>Mobile</label>
                            <input type="text" name="mobile" class="form-control" value="{{$user->mobile}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Date Of Birth</label>
                            <input type="date" name="dob" placeholder="Input your Date of Birth" class="form-control" value="{{$user->dob}}"/>
                        </div>
                        <div class="col">
                            <label>Profession</label>
                            <input type="text" name="profession" placeholder="Input your profession" class="form-control" value="{{$user->profession}}"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Organization Name</label>
                            <input type="text" name="orgname" placeholder="Input your Organization Name" class="form-control" value="{{$user->orgname}}" />
                        </div>
                        <div class="col">
                            <label>WhatsApp</label>
                            <input type="text" name="whatsapp" placeholder="Input your WhatsApp" class="form-control" value="{{$user->whatsapp}}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Address</label>
                            <input name="address" placeholder="Input your address" class="form-control" value="{{$user->address}}" />
                        </div>
                        <div class="col">
                            <label>City</label>
                            <input type="text" name="city" placeholder="Input your city" class="form-control" value="{{$user->city}}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Pincode</label>
                            <input type="text" name="pincode" placeholder="Input your pincode" class="form-control" value="{{$user->pincode}}"/>
                        </div>
                        <div class="col">
                            <label>State</label>
                            <input type="text" name="state" placeholder="Input your State" class="form-control" value="{{$user->state}}"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Country</label>
                            <input type="text" name="country" placeholder="Input your Country" class="form-control" value="{{$user->country}}" />
                        </div>
                        <div class="col">
                            <label>Account Refferal</label>
                            <input type="text" placeholder="Input your refferal name" class="form-control" value="{{$user->reffered->fname ?? ''}} {{$user->reffered->lname ?? ''}}" readonly/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col pt-3">
                            <input type="submit" class="btn btn-success btn-block" value="Save">
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        {{-- Right Part --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Login Information</div>
                <div class="card-body">
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
        </div>
    </div>
</div>
@endsection

@section('headers')
<style>
.card-body{
    text-align: left !important;
}
</style>
@endsection

