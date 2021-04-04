@extends('larnr::layouts.user')

@section('content')
<div class="container">
    <div class="row pt-4 pb-4 justify-content-center align-items-center">
            <div class="col-md-7 text-center d-none d-md-block">
                <h5 class="text-warning">Do you finding a good opportunity?</h5>
                <h2 class="text-light">Quick Join Now.</h2>
                <h6>Never Loose the opportunities.</h6>
            </div>
            <div class="col-md-4 bg-light block">
                <div class="row p-2">
                    <div class="col text-center">
                        <h2>{{ __('Register') }}</h2>
                    </div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @captchaHTML
                <div class="row p-2">
                    <div class="col-md-3">
                        {{ __('Name') }}<span class="text-danger">*</span>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col">
                                <input id="name" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>
                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-3">
                        {{ __('Mobile') }}<span class="text-danger">*</span>
                    </div>
                    <div class="col-md-9">
                        <input id="email" type="mobile" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-3">
                        {{ __('E-Mail') }}<span class="text-danger">*</span>
                    </div>
                    <div class="col-md-9">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-3">
                        {{ __('Password') }}<span class="text-danger">*</span>
                    </div>

                    <div class="col-md-9">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="row p-2">
                    <div class="col-md-3">
                        {{ __('Confirm Password') }}<span class="text-danger">*</span>
                    </div>

                    <div class="col-md-9">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-sign-in"></i>
                            Sign Up
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
