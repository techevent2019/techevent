@extends('layouts.app')

@section('content')

<div class="text-center" style="padding:50px 0">
    <div class="logo">login As HOD</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="login-form" class="text-left" method="POST" action="{{ route('hod.login.submit') }}">
        @csrf

            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="lg_username" class="sr-only">E-Mail Address</label>
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="lg_password" class="sr-only">Password</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group login-group-checkbox">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="lg_remember">remember</label>
                    </div>

                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>

            @if (Route::has('password.request'))
            <div class="etc-login-form">
                <p>forgot your password? <a href="{{ route('hod.password.request') }}">click here</a></p>
            </div>
            @endif

        </form>
    </div>
    <!-- end:Main Form -->
</div>


@endsection