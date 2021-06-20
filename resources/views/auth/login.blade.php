@extends('layouts.user')
@section('title') User Login @endsection

@section('content')
<div class="bg-dark" style="min-height: 82vh">
<div class="container">
        <div class="row pt-5 pb-5 justify-content-center">
            <div class="col-md-6 bg-light block">
                <div class="row p-2">
                    <div class="col text-center">
                        <h2>{{ __('Login') }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @if (session('status'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @captchaHTML
                <div class="row p-2">
                    <div class="col-4 text-dark">
                        {{ __('E-Mail Address') }}<span class="text-danger">*</span>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-4 text-dark">
                        {{ __('Password') }}<span class="text-danger">*</span>
                    </div>
                    <div class="col-8">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Do you forget password?</a>
                        @endif
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-sign-in"></i>
                            Login
                        </button>
                    </div>
                    <div class="col text-center">
                        <button type="reset" class="btn btn-info btn-block">
                            <i class="fa fa-close"></i>
                            Clear
                        </button>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col text-center">
                        <a href="{{ route('signup')}}" class="btn btn-primary btn-block">
                           <i class="fa fa-id-card-o"></i>
                           {{__('Register In ').config('app.name') }}
                       </a>
                    </div>
                </div>

                <!-- Error Display Section -->
                {{-- <hr class="err-divider" />
                <div class="row p-2">
                    <div class="col">
                        <div class="alert alert-danger" role="alert">
                            A simple danger alert—check it out!
                        </div>
                    </div>
                </div> --}}
                <!-- Error Display Section -->
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
