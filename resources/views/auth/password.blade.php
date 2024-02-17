@extends('layout.auth')
@section('title', 'Password | Reset ')
@section('content')
    <div class="row w-100">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    <img src="{{ asset('assets/images/logo.svg') }} ">
                </div>

                @include('layout.partials.messages')

                <h4>Forgot Password ?</h4>
                <h6 class="font-weight-light">Update your password</h6>
                <form class="pt-3" method="POST" action="{{ route('auth.password') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-lg"
                            placeholder="New Password">
                        @if ($errors->has('password'))
                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="mt-3">
                        <button type="submit"
                            class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SUBMIT</button>
                    </div>
                    <div class="text-center mt-4 font-weight-light">
                        Login now <a href="{{ route('auth.login') }}" class="text-primary">Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
