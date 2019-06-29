@extends('layouts.admin')
@section('content')
<section class="content-header">
	<h1>
	Events
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i> admin </a></li>
		<li><a href="{{ route('admin.event.index') }}"> Events </a></li>
		<li class="active">Display Events</li>
	</ol>
</section>
<div class="page-header">
	<h1>Edit And Delete Event to calander
	<div class="col-md-4" style="float: right;">
		<form action="{{ route('admin.event.display') }}" method="get" >
			<div class="input-group">
				<input type="text" class="form-control" name="ss"
				placeholder="Search Events" value="{{ isset($ss) ? $ss : '' }}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">
					<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</form></br>
	</div>
	</h1>
</div>
<div ></div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
	<tr>
		
		<th>ID</th>
		<th>Event Name</th>
		<th>Event Start Date</th>
		<th>Event End Date</th>
		<th>Last Registration Date for Event</th>
		<th>Event Start Time</th>
		<th>Event End Time</th>
		<th>Event Place</th>
		<th>College Code</th>
		<th>Department</th>
		<th>TechFest Name</th>
		<th>Level</th>
		<th>Team Member</th>
		{{-- <th>Event Codinator Id</th> --}}
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@if(count($events))
	@foreach($events as $e)
	<tr>
		<td>{{ $e->id }}</td>
		<td>{{ $e->event_name }}</td>
		<td>{{ $e->event_start_date }}</td>
		<td>{{ $e->event_end_date }}</td>
		<td>{{ $e->event_last_registration_date }}</td>
		<td>{{ $e->event_start_time }}</td>
		<td>{{ $e->event_end_time }}</td>
		<td>{{ $e->event_place }}</td>
		<td>{{ $e->col_cod }}</td>
		<td>{{ $e->department }}</td>
		<td>{{ $e->techfest_name }}</td>
		<td>{{ $e->level }}</td>
		<td>Min-{{ $e->min_member }}, Max-{{ $e->max_member }}</td>
		{{-- <td>{{ $e->e_c_id }}</td> --}}
		<td>
			<a href="{{route('admin.event.edit1',$e->id) }}" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i></a>
		</td>
		<td>
			<form action="{{ route('admin.event.destroy1',$e->id) }}" method="POST">
				{{ csrf_field() }}
				
				<input type="hidden" name="_method" value="DELETE"/>
				<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
			</form>
		</td>
		
	</tr>
	@endforeach
	@else
	<tr><td colspan="10"><h1>No Event Found</h1></td></tr>
	@endif
</table>
</div>
{{ $events->appends(['ss' => $ss])->links() }}
@endsection