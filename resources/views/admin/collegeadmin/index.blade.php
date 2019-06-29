@extends('layouts.admin')
@section('content')
<section class="content-header">
	<h1>
	College Admin
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i> admin </a></li>
		<li class="active">College Admin</li>
	</ol>
</section>
<div class="page-header">
	
	<a href="{{ route('admin.collegeadmin.create') }}" class="btn btn-primary"> Add New College Admin</a>
	
	<div class="col-md-4" style="float: right;">
		<form action="{{ route('admin.collegeadmin.index') }}" method="get" role="search">
			<div class="input-group">
				<input type="text" class="form-control" name="ss" value="{{ isset($ss) ? $ss : '' }}"
				placeholder="Search College Admin"
				> <span class="input-group-btn">
					<button type="submit" class="btn btn-primary">
					<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</form>
	</div>
</div></br>
@if(\Session::has('success'))
<div class="alert alert-success">
	<p>{{ \Session::get('success')}}</p>
</div>
@endif
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<tr>
			<th>ID</th>
			<th>College Name</th>
			<th>College Email</th>
			<th>College Address</th>
			<th>College Contact No.</th>
			<th>College Code</th>
			<th>College City</th>
			<th>College Principal Name</th>
			<th>College Admin Name</th>
			<th>College Admin Contact No.</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		@if(count($collegeadmins))
		@foreach($collegeadmins as $c)
		<tr>
			<td>{{ $c->id }}</td>
			<td>{{ $c->col_name }}</td>
			<td>{{ $c->email }}</td>
			<td>{{ $c->col_address }}</td>
			<td>{{ $c->col_con_no }}</td>
			<td>{{ $c->col_code }}</td>
			<td>{{ $c->col_city }}</td>
			<td>{{ $c->col_principal_name }}</td>
			<td>{{ $c->col_admin_name }}</td>
			<td>{{ $c->admin_con_no }}</td>
			<td>
				<a href="{{route('admin.collegeadmin.edit',$c->id) }}" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i></a>
			</td>
			<td>
				<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
				<form action="{{ route('admin.collegeadmin.destroy',$c->id) }}" method="post">
					@method('DELETE')
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>
			</td>
		</tr>
		@endforeach
		@else
		<tr><td colspan="3">No Category Found</td></tr>
		@endif
	</table>
</div>
{{ $collegeadmins->appends(['ss' => $ss])->links() }}
@endsection