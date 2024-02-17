@extends('layout.auth')
@section('title', 'Login')
@section('content')
    <div class="row w-100">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    <img src="{{ asset('assets/images/logo.svg') }} ">
                </div>

                @include('layout.partials.messages')

                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST" action="{{ route('login') }} ">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="mt-3">
                        <button type="submit"
                            class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN
                            IN</button>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" name="remember" class="form-check-input">
                                Keep me signed in
                            </label>
                        </div>
                        <a href="#" class="auth-link text-black">Forgot password?</a>
                    </div>
                    <div class="text-center mt-4 font-weight-light">
                        Don't have an account? <a href="#" class="text-primary">Create</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
