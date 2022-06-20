@extends('larnr::layouts.master')

@section('content')
<div class="back-dark">
<div class="container contents">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3 class="text-center"><i class="fa fa-check-circle"></i> Payment Report Section</h3>
                </div>

                <div class="card-body text-center" style="min-height: 510px">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-6 col-12 shadow p-5 bg-white rounded">
                            @if($payment_status == 'Credit')
                                <h1 class="text-success"><i class="fa fa-check-circle"></i> Your Payment processed successfully.</h1>
                                @if(Auth::user())
                                    <a class="m-4 btn btn-primary btn-lg" href="{{url('user/my-courses')}}">Goto Your Courses</a>
                                @else
                                    <a class="m-4 btn btn-primary btn-lg" href="https://app.larnr.com/signup">Goto Signup</a>
                                @endif
                            @else
                                <h1 class="text-danger"><i class="fa fa-exclamation-circle"></i> Your Payment processed not successful.</h1>
                            @endif
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
