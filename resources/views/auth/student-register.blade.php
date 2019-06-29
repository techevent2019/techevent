@extends('layouts.app')
@section('content')

<div class="text-center" style="padding:50px 0">
    <div class="logo">Student Register</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="register-form" class="text-left" method="POST" action="register">
         @csrf
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="reg_username" class="sr-only">Student Name</label>
                        <input type="text" class="form-control{{ $errors->has('stu_name') ? ' is-invalid' : '' }}" id="stu_name" name="stu_name" placeholder="Student name" value="{{ old('stu_name') }}" required autofocus>

                    @if ($errors->has('stu_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stu_name') }}</strong>
                        </span>
                    @endif
                    </div>

                    <div class="form-group">
                        <label for="reg_username" class="sr-only">Email address</label>
                        <input placeholder="E-Mail Address" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" value="{{ old('email') }}" required autofocus>

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



                    <div class="form-group">
                        <label for="reg_enrollment_no" class="sr-only">Enrollment No.</label>
                        <input type="text" class="form-control{{ $errors->has('stu_enrollment_no') ? ' is-invalid' : '' }}" id="stu_enrollment_no" name="stu_enrollment_no" placeholder="Enrollment No." value="{{ old('stu_enrollment_no') }}" required>
                        @if ($errors->has('stu_enrollment_no'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('stu_enrollment_no') }}</strong>
                            </span>
                         @endif
                    </div>
                    <div class="form-group">
                        <label for="reg_contect_no" class="sr-only">Contect No.</label>
                        <input type="text" class="form-control {{ $errors->has('stu_con_no') ? ' is-invalid' : '' }} " id="stu_con_no" name="stu_con_no" placeholder="Contect No." value="{{ old('stu_con_no') }}" required>
                        @if ($errors->has('stu_con_no'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('stu_con_no') }}</strong>
                            </span>
                         @endif
                    </div>

                    <div class="form-group">
                        <label for="reg_department" class="sr-only">Department</label>
                        <input type="text" class="form-control {{ $errors->has('stu_department') ? ' is-invalid' : '' }} " id="stu_department" name="stu_department" placeholder="Department" value="{{ old('stu_department') }}"  required>
                        @if ($errors->has('stu_department'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('stu_department') }}</strong>
                            </span>
                         @endif
                    </div>

                    <div class="form-group">
                        <label for="reg_college_code" class="sr-only">College code</label>
                        <input type="text" class="form-control {{ $errors->has('stu_col_code') ? ' is-invalid' : '' }} " id="stu_col_code" name="stu_col_code" placeholder="College code"  value="{{ old('stu_col_code') }}" required>
                        @if ($errors->has('stu_col_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('stu_col_code') }}</strong>
                            </span>
                         @endif
                    </div>

                    <div class="form-group">
                        <label for="reg_college_code" class="sr-only">College Name</label>
                        <input type="text" class="form-control {{ $errors->has('stu_col_name') ? ' is-invalid' : '' }} " id="stu_col_name" name="stu_col_name" placeholder="College Name"  value="{{ old('stu_col_name') }}" required>
                        @if ($errors->has('stu_col_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('stu_col_name') }}</strong>
                            </span>
                         @endif
                    </div>
                    
                    <div class="form-group login-group-checkbox">
                        <input type="radio" class="" name="stu_gender" id="male" value="male" checked="">
                        <label for="male">male</label>
                        
                        <input type="radio" class="" name="stu_gender" id="female" value="female">
                        <label for="female">female</label>
                    </div>

                    <div class="form-group">
                        <label for="stu_sem" class="sr-only">semester</label>
                        <select name="stu_sem" class="form-control" value="{{ old('stu_sem') }}" required>
                            <option value="">Choose semester</option>
                            <option value="1">1' semester</option>
                            <option value="2">2' semester</option>
                            <option value="3">3' semester</option>
                            <option value="4">4' semester</option>
                            <option value="5">5' semester</option>
                            <option value="6">6' semester</option>
                            <option value="7">7' semester</option>
                            <option value="8">8' semester</option>
                        </select>
                    </div>                 
                </div>


                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
           <!--  -->
        </form>
    </div>
    <!-- end:Main Form -->
</div>
@endsection
