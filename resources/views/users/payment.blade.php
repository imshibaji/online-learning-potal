@extends('layouts.user')

@section('content')
<div class="back-dark">
<div class="container contents">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3 class="text-center"><i class="fa fa-check-circle"></i> Payment Section</h3>
                </div>

                <div class="card-body text-center" style="min-height: 510px">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-6 col-12 shadow p-5 bg-white rounded">
                            <h4 class="text-success"><i class="fa fa-info-circle"></i> {{$pay->purpose}}</h4>
                            <h5>Price: 
                                <strong class="text-success">₹{{ $pay->amount }}/-</strong>,
                            </h5>
                            <p class="text-secondary">Please Click Pay button for Payment</p>
                            <div class="p-3 mb-5">
                                <a href="{{$pay->longurl}}" class="btn btn-success btn-lg btn-block">Pay Now</a>
                            </div>
                        </div>
                    </div>
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