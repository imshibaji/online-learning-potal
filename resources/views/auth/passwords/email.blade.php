@extends('layouts.user')
@section('title') Reset Your password @endsection

@section('content')
<div class="container">
    <div class="row pt-5 pb-5 justify-content-center">
        <div class="col-md-6 bg-light block">
            <div class="row p-2">
                <div class="col text-center">
                    <h2>{{ __('Reset Password') }}</h2>
                </div>
            </div>

            <div class="row p-2">
                <div class="col">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                @captchaHTML
                <div class="row p-2">
                    <div class="col-4">
                        {{ __('E-Mail Address') }}<span class="text-danger">*</span>
                    </div>

                    <div class="col-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-key"></i>
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
        </form>

        </div>
    </div>
</div>
@endsection
