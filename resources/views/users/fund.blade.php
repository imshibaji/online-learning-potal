@extends('layouts.user')

@section('content')
<div id="app" class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transaction Details</div>

                <div class="card-body" style="min-height: 600px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{-- Other Payment Information --}}
                    {{--
                    <h3 class="text-center">Other Payment Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="shadow-none p-3 mb-5 bg-light rounded">
                                <h5>Netbanking Information</h5>
                                <p>HDFC BANK<br/>
                                Gorabazar, Dum Dum Cantonment, Kolkata-700028, WB.<br/>
                                Account Holder: Shibaji Debnath<br/>
                                A/c No: 01061000224409<br/>
                                IFSC Code: HDFC0000106</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="shadow-none p-3 mb-5 bg-light rounded">
                                <h5>Online Payment Information</h5>
                                <p>Google Pay Number: 8981009499<br/>
                                PhonePe Number: 8981009499,<br/>
                                PayTM Number: 8981009499
                                <br/><br/>
                                This Payment is accetable from india.
                            </p>
                            </div>
                        </div>
                    </div>
                    --}}
                    {{-- Other Payment Information --}}


                    {{-- Payment History --}}
                    <h3 class="text-center">Transaction History</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Your Balance: ₹{{$balance}}/-</h4>
                            <p class="muted">Total Amount Uses: ₹{{$totalPaid}}/-</p>

                            <x-data-table :fields="$fields" :items="$items" />
                            {{ $items->links() }}
                        </div>
                        {{--
                        <div class="col-md-4 col-12 shadow p-3 mb-5 bg-white rounded">
                            <h3 class="text-center">Subscription Plan</h3>
                            <div class="p-4 silver-box">
                                <h4>Silver Plan</h4>
                                <p>You will be getting 10 Live class. Where you can give Live Question and Answer in the session</p>
                                <p>Fees: 5000/-</p>
                                <button class="btn btn-block btn-silver btn-lg">Buy Plan</button>
                            </div>
                            <div class="p-4 gold-box">
                                <h4>Gold Plan</h4>
                                <p>Silver plan with Coaching Support for 3month</p>
                                <p>Fees: 10,000/-</p>
                                <button class="btn btn-block btn-warning btn-lg">Buy Plan</button>
                            </div>
                            <div class="p-4 platinum-box">
                                <h4>Platinum Plan</h4>
                                <p>Gold plan with Coaching Support for 6month</p>
                                <p>Fees: 20,000/-</p>
                                <button class="btn btn-block btn-primary btn-lg">Buy Plan</button>
                            </div>
                        </div>
                        --}}
                    </div>
                    {{-- Page End Here --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('headers')
<style>
.btn-silver{
    background-color: lightslategray;
    color: whitesmoke;
}
.silver-box{
    border: 1px solid lightslategray;
}
.silver-box h4{
    color: lightslategray;
    text-align: center;
}
.gold-box{
    border: 2px solid #e8d101;
}
.gold-box h4{
    color: #e8d101;
    text-align: center;
}
.platinum-box{
    border: 3px solid #3490dc;
}
.platinum-box h4{
    color: #3490dc;
    text-align: center;
}
</style>
@endsection