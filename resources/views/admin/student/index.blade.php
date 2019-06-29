@extends('layouts.admin')
@section('content')
<section class="content-header">
	<h1>
	Students
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i> admin </a></li>
		<li class="active">Students</li>
	</ol>
</section>
<section class="content-header">
	<div class="conrainer-fluid">
		<h2>Students
		
		<div class="col-md-4" style="float: right;">
			<form action="{{ route('admin.student.index') }}" method="get" >
				<div class="input-group">
					<input type="text" class="form-control" name="ss"
					placeholder="Search Students" value="{{ isset($ss) ? $ss : '' }}">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary">
						<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</form>
		</div>
		</h2></div>
		@if(\Session::has('success'))
		<div class="alert alert-success">
			<p>{{ \Session::get('success')}}</p>
		</div>
		@endif
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<tr>
					<th>ID</th>
					<th>Student Name</th>
					<th>Student Enrollment No.</th>
					<th>Student Email</th>
					<th>Student Contact No.</th>
					<th>Student Department</th>
					<th>Student College Code</th>
					<th>Student College Name</th>
					<th>Student Gender</th>
					<th>Student Semester</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				@if(count($students))
				@foreach($students as $s)
				<tr>
					<td>{{ $s->id }}</td>
					<td>{{ $s->stu_name }}</td>
					<td>{{ $s->stu_enrollment_no }}</td>
					<td>{{ $s->email }}</td>
					<td>{{ $s->stu_con_no }}</td>
					<td>{{ $s->stu_department }}</td>
					<td>{{ $s->stu_col_code }}</td>
					<td>{{ $s->stu_col_name }}</td>
					<td>{{ $s->stu_gender }}</td>
					<td>{{ $s->stu_sem }}</td>
					<td>
						<a href="{{route('admin.student.edit',$s->id) }}" class="btn btn-info"> <i class="glyphicon glyphicon-edit"></i></a>
					</td>
					<td>
						<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
						<form action="{{ route('admin.student.destroy',$s->id) }}" method="post">
							@method('DELETE')
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					</td>
				</tr>
				@endforeach
				@else
				<tr><td colspan="3">No Student Found</td></tr>
				@endif
			</table>
		</div>
			{{ $students->appends(['ss' => $ss])->links() }}
			
		</div>

	</section>
	@endsection