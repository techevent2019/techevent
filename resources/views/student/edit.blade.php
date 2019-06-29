@extends('layouts.student')
@section('content')

<section class="content-header">
    <h1>
        Edit Student Admin
        <small>Control panel</small>
    </h1>
    {{-- <ol class="breadcrumb">
	    <li><a href="{{ route('admin.admin') }}"><i class="fa fa-dashboard"></i> Admin </a></li>
	    <li><a href="{{ route('admin.student.index') }}"> Student </a></li>
        <li class="active">Edit Student Admin</li>
    </ol> --}}
</section>


<section class="content-header">
	<div class="conrainer-fluid">
		<form method="post" action="{{ route('student.update',$students->id) }}">
			@method('PUT')
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Student Name</label>
					<div class="col-md-6"><input type="text" name="stu_name" class="form-control {{ $errors->has('stu_name') ? ' is-invalid' : '' }}" value="{{ $students->stu_name}}">
					@if ($errors->has('stu_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stu_name') }}</strong>
                        </span>
                    @endif
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Student Email Id</label>
					<div class="col-md-6"><input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $students->email}}">
					@if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
					</div>
					<div class="clearfix"></div>
				</div>			
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Student Enrollment No.</label>
					<div class="col-md-6"><input type="text" name="stu_enrollment_no" class="form-control {{ $errors->has('stu_enrollment_no') ? ' is-invalid' : '' }}" value="{{ $students->stu_enrollment_no}}" readonly>
					@if ($errors->has('stu_enrollment_no'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stu_enrollment_no') }}</strong>
                        </span>
                    @endif
					</div>
				</div>			
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Student Contact No.</label>
					<div class="col-md-6"><input type="text" name="stu_con_no" class="form-control {{ $errors->has('stu_con_no') ? ' is-invalid' : '' }}" value="{{ $students->stu_con_no}}">
					@if ($errors->has('stu_con_no'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stu_con_no') }}</strong>
                        </span>
                    @endif
					</div>
				</div>			
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Student Department</label>
					<div class="col-md-6"><input type="text" name="stu_department" class="form-control {{ $errors->has('stu_department') ? ' is-invalid' : '' }}" value="{{ $students->stu_department}}">
					@if ($errors->has('stu_department'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stu_department') }}</strong>
                        </span>
                    @endif
					</div>
				</div>			
			</div>
								
			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Student College Code</label>
					<div class="col-md-6"><input type="text" name="stu_col_code" class="form-control {{ $errors->has('stu_col_code') ? ' is-invalid' : '' }}" value="{{ $students->stu_col_code}}"readonly>
					@if ($errors->has('stu_col_code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stu_col_code') }}</strong>
                        </span>
                    @endif
					</div>
				</div>			
			</div>
								
			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Student College Name</label>
					<div class="col-md-6"><input type="text" name="stu_col_name" class="form-control {{ $errors->has('stu_col_name') ? ' is-invalid' : '' }}" value="{{ $students->stu_col_name}}"readonly>
					@if ($errors->has('stu_col_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stu_col_name') }}</strong>
                        </span>
                    @endif
					</div>
				</div>
			</div>

			<div class="form-group login-group-checkbox">
				<div class="row">
					<label class="col-md-3">Student Gender</label>
					<div class="col-md-6">
                        <input type="radio" class="" name="stu_gender" id="male" value="male" <?php if ($students->stu_gender == 'male'): ?>
                                    checked
                                <?php endif ?>>
                        <label for="male">male</label>
                        
                        <input type="radio" class="" name="stu_gender" id="female" value="female"<?php if ($students->stu_gender == 'female'): ?>
                                    checked
                                <?php endif ?> >
                        <label for="female">female</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
	            <div class="row">
					<label class="col-md-3">Student semester</label>
					<div class="col-md-6">
	                    <select name="stu_sem" class="" value="{{ old('stu_sem') }}" required>
	                    	<option value="">Choose Event Name</option>
                            
                            <option value="{{ $students->stu_sem }}"
                                    selected> {{ $students->stu_sem }}' semester
							</option>
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
            </div>
                     

            <div class="form-group">
				<input type="submit" class="btn btn-info" value="Save">
			</div>               
               

		</form>
	</div>
</section>
@endsection