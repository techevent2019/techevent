@extends('layouts.app')

@section('content')

<div class="text-center" style="padding:50px 0">
    <div class="logo">forgot password for College Admin</div>
    <!-- Main Form -->
    <div class="login-form-1">
         <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

        <form id="forgot-password-form" class="text-left" method="POST" action="{{ route('collegeadmin.password.email') }}">
        @csrf

            <div class="etc-login-form">
                <p>For new password we will send you Email </p>
            </div>
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="fp_email" class="sr-only">Email address</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="email address">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>


@endsection
