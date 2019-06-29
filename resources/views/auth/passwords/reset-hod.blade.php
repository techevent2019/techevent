@extends('layouts.app')

@section('content')

<div class="text-center" style="padding:50px 0">
    <div class="logo">register</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="register-form" class="text-left" method="POST" action="{{ route('hod.password.request') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="reg_username" class="sr-only">Email address</label>
                        <input placeholder="E-Mail Address" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="reg_password" class="sr-only">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                         @endif

                    </div>

                    <div class="form-group">
                        <label for="reg_password_confirm" class="sr-only">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required >
                    </div>
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>


@endsection
