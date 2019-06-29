@extends('layouts.admin')

@section('content')

<section class="content-header">
    <h1>
        Event Codinator
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i> admin </a></li>
        <li><a href="{{route('admin.eventcodinator.index')}}"> Event Codinator </a></li>
        <li class="active">Add Event Codinator</li>
    </ol>
</section>

<div class="conrainer-fluid">
        <h2>Add New Event Codinator

        <div class="col-md-4" style="float: right;">
	    	<form action="{{ route('admin.eventcodinator.display') }}" method="get" >
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

		</h2></br>

<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				
				<th>ID</th>
				<th>Student Name</th>
				<th>Student Email</th>
				<th>Student Enrollment No.</th>
				<th>Student Contact No.</th>
				<th>College Name</th>
				<th>Student College Code</th>
				<th>Student Department</th>
				<th>Student Gender</th>
				<th>Student Semester</th>
				<th>Action</th>
			</tr>
			@if(count($students))
			@foreach($students as $s)
				<tr>
					<td>{{ $s->id }}</td>
					<td>{{ $s->stu_name }}</td>
					<td>{{ $s->email }}</td>
					<td>{{ $s->stu_enrollment_no }}</td>
					<td>{{ $s->stu_con_no }}</td>
					<td>{{ $s->stu_col_name }}</td>
					<td>{{ $s->stu_col_code }}</td>
					<td>{{ $s->stu_department }}</td>
					<td>{{ $s->stu_gender }}</td>
					<td>{{ $s->stu_sem }}</td>
					<td>
						<a href="{{route('admin.eventcodinator.show1',$s->id) }}" class="btn btn-info">Add As Event Codinator</a>
					</td>
				</tr>
			@endforeach
			@else
			<tr><td colspan="10"><h1>No Students Found</h1></td></tr>
			@endif
		</table>
	</div>
		{{ $students->appends(['ss' => $ss])->links() }}
	</div>
@endsection