@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>
        Edit Collage Admin
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
	    <li><a href="{{ route('admin.admin') }}"><i class="fa fa-dashboard"></i> Admin </a></li>
	    <li><a href="{{ route('admin.collegeadmin.index') }}"> College Admin </a></li>
        <li class="active">Edit College Admin</li>
    </ol>
</section>


<section class="content-header">
	<div class="conrainer-fluid">
		<form action="{{ route('admin.collegeadmin.update',$id) }}"
		method="POST" enctype="multipart/form-data">
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
				<div class="row">
                    <label for="image" class="col-md-3">image</label>
                    <input type="file" name="image" value="{{ $collegeadmin->image }}"/>
                    @if($collegeadmin->image)
                            <img src="{{ asset('public/storage/colleges/'.$collegeadmin->image) }}" style="width: 150px;"/>
                    @endif
                </div>
                </div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">College Name</label>
					<div class="col-md-6"><input type="text" name="col_name" class="form-control {{ $errors->has('col_name') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->col_name}}">
						@if ($errors->has('col_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('col_name') }}</strong>
                        </span>
                    @endif
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">Email</label>
					<div class="col-md-6"><input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->email}}" >
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
					<label class="col-md-3">College Address</label>
					<div class="col-md-6"><input type="text" name="col_address" class="form-control {{ $errors->has('col_address') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->col_address}}">
					@if ($errors->has('col_address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('col_address') }}</strong>
                        </span>
                    @endif
                </div>

					<div class="clearfix"></div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">College Contact No.</label>
					<div class="col-md-6"><input type="integer" name="col_con_no" class="form-control {{ $errors->has('col_con_no') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->col_con_no}}">
					@if ($errors->has('col_con_no'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('col_con_no') }}</strong>
                        </span>
                    @endif
                </div>

					<div class="clearfix"></div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">College Code</label>
					<div class="col-md-6"><input type="integer" name="col_code" class="form-control {{ $errors->has('col_code') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->col_code}}">
					@if ($errors->has('col_code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('col_code') }}</strong>
                        </span>
                    @endif
                </div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">College City</label>
					<div class="col-md-6"><input type="text" name="col_city" class="form-control {{ $errors->has('col_city') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->col_city}}">
					@if ($errors->has('col_city'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('col_city') }}</strong>
                        </span>
                    @endif
                </div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">College Principal Name</label>
					<div class="col-md-6"><input type="text" name="col_principal_name" class="form-control {{ $errors->has('col_principal_name') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->col_principal_name}}">
					@if ($errors->has('col_principal_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('col_principal_name') }}</strong>
                        </span>
                    @endif
                </div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">College Admin Name</label>
					<div class="col-md-6"><input type="text" name="col_admin_name" class="form-control {{ $errors->has('col_admin_name') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->col_admin_name}}">
					@if ($errors->has('col_admin_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('col_admin_name') }}</strong>
                        </span>
                    @endif
                </div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-3">College Admin Contact No.</label>
					<div class="col-md-6"><input type="integer" name="admin_con_no" class="form-control {{ $errors->has('admin_con_no') ? ' is-invalid' : '' }}" value="{{ $collegeadmin->admin_con_no}}">
					@if ($errors->has('admin_con_no'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('admin_con_no') }}</strong>
                        </span>
                    @endif
                </div>

					<div class="clearfix"></div>
				</div>
			</div>

			</div>
			@method('PUT')
			<div class="form-group">
				<input type="submit" class="btn btn-info" value="Update">
			</div>

		</form>
	</div>
</section>
@endsection