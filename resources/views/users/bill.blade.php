@extends('layouts.user')

@section('content')
<div class="back-dark">
<div class="container contents">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3 class="text-center"><i class="fa fa-check-circle"></i> Billing Section</h3>
                </div>

                <div class="card-body text-center p-5" style="min-height: 510px">
                    <h4 class="text-success"><i class="fa fa-info-circle"></i> {{$course->title}}</h4>
                    <h5>Price:
                        @if($course->offer_price != null)
                            <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                            <strong class="text-success">₹{{ $course->offer_price }}/-</strong>,
                        @else
                            <strong class="text-success">₹{{ $course->actual_price }}/-</strong>,
                        @endif
                    </h5>
                    <p class="text-secondary">Please input your Billing Information</p>
                    <table class="table">
                        <form action="{{route('billpay')}}" method="POST">
                            @php
                                $price = $course->actual_price;
                                if($course->offer_price){
                                    $price = $course->offer_price;
                                }
                            @endphp
                            @csrf
                            <input type="hidden" name="uid" value="{{Auth::id()}}">
                            <input type="hidden" name="cid" value="{{$course->id}}">
                            <input type="hidden" name="pps" value="{{$course->title}}">
                            <input type="hidden" name="amt" value="{{$price}}">
                        <tr>
                            <td>Biller Name</td>
                            <td><input class="form-control" type="text" name="name" placeholder="Input Biller Name" required value="{{$user->fname ?? ''}}{{ isset($user->lname)? ' '.$user->lname : ''}}"></td>
                        </tr>
                        <tr>
                            <td>Biller Email</td>
                            <td><input class="form-control" type="email" name="email" placeholder="Input Biller Email" required value="{{$user->email ?? ''}}"></td>
                        </tr>
                        <tr>
                            <td>Biller Mobile</td>
                            <td><input class="form-control" type="number" name="mobile" placeholder="Input Biller Mobile No" required value="{{$user->mobile ?? ''}}"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input class="btn btn-info btn-lg btn-block" type="submit" value="Checkout Now"></td>
                        </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('headers')
<style>
.back-dark{
    background-color: #343a40;
}
</style>
@endsection
