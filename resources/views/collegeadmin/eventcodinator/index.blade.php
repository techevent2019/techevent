@extends('layouts.collegeadmin')
@section('content')

<section class="content-header">
    <h1>
        Event Codinator
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
	    <li><a href="{{route('collegeadmin.dashbord')}}"><i class="fa fa-dashboard"></i>College admin </a></li>
        <li class="active">Event Codinator</li>
    </ol>
</section>
<section class="content-header">
	<div class="conrainer-fluid">
		
		<a href="{{ route('collegeadmin.eventcodinator.display') }}" class="btn btn-primary"> Add New Event Codinator</a>

		<div class="col-md-4" style="float: right;">
	    	<form action="{{ route('collegeadmin.eventcodinator.index') }}" method="get" >
	    		<div class="input-group">
	    	    <input type="text" class="form-control" name="ss" 
	            placeholder="Search Event Codinators" value="{{ isset($s) ? $s : '' }}"> 
	            <span class="input-group-btn">
	            	<button type="submit" class="btn btn-primary">
	                <span class="glyphicon glyphicon-search"></span>
	            	</button>
	        	</span>
	    		</div>
			</form></br>
		</div></br></br>
		@if(\Session::has('success'))
				<div class="alert alert-success">
					<p>{{ \Session::get('success')}}</p>
				</div>
		@endif
<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Id</th>
				<th>Event Name</th>
				<th>Event id</th>
				<th>Event Codinator Name</th>
				<th>EventCodinator Email</th>
				<th>Enrollment No.</th>
				<th>Contacet No.</th>
				<th>Department</th>
				<th>Semester</th>
				<th>Gender</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			@if(count($eventcodinators))
			@foreach($eventcodinators as $ec)
				<tr>
					<td>{{ $ec->id }}</td>
					<td>{{ $ec->event_name }}</td>
					<td>{{ $ec->event_id }}</td>
					<td>{{ $ec->stu_name }}</td>
					<td>{{ $ec->email }}</td>
					<td>{{ $ec->ec_enrollment_no }}</td>
					<td>{{ $ec->stu_con_no }}</td>
					<td>{{ $ec->stu_department }}</td>
					<td>{{ $ec->stu_sem }}</td>
					<td>{{ $ec->stu_gender }}</td>

					<td>
						<a href="{{route('collegeadmin.eventcodinator.edit',$ec->id) }}" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i></a>
					</td>
					<td>
						<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
							<form action="{{ route('collegeadmin.eventcodinator.destroy',$ec->id) }}" method="post">
								@method('DELETE')
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>
					</td>
				</tr>
			@endforeach
			@else
			<tr><td colspan="10"><h1>No Event Codinator Found</h1></td></tr>
			@endif
		</table>
	</div>
		{{ $eventcodinators->appends(['ss' => $s])->links() }}
		
	</div>
</section>
@endsection