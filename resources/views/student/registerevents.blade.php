@extends('layouts.student')
@section('content')
<section class="content-header">
	
</section>
<section class="content-header" style="margin-top: 10px">
	<div class="conrainer-fluid">
		
		<h1>You are participant in This Events</h1>
		@if(\Session::has('alert'))
    <div class="alert alert-danger">
        <p>{{ \Session::get('alert')}}</p>
    </div>
@endif
<div style="overflow-x:auto;">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Event Name</th>
				<th>Event Start Date</th>
				<th>Event End Date</th>
				<th>Event Price</th>
				<th>Event College Name</th>
				<th>Event Detail</th>
				<th>Team Detail </th>
				<th>Cartificate</th>
				{{-- <th>Score</th> --}}
			</tr>
			@if(count($participant))
			@foreach($participant as $p)
			<tr>
				<td>{{ $p->event_name }}</td>
				<td>{{ $p->event_start_date }}</td>
				<td>{{ $p->event_end_date }}</td>
				<td>{{ $p->evetn_price }}</td>
				<td>{{ $p->college_name }}</td>
				<td>
					<a href="{{ route('student.event',$p->event_id) }}" class="btn btn-info">Details</a>
				</td>
				<?php
					$max =  $p->max_member;
					$min =  $p->min_member;
					$leader =  $p->leader;
				$team_id = $p->stu_enrollment_no?>
				@if ($min > 1 )
				<td>
					<a href="{{ route('student.teamdetail',$p->event_id) }}" class="btn btn-info">Team</a>
					{{-- <form action="{{ route('student.teamdetail') }}" method="get">
						<input type="hidden" name="event_id" value="{{$p->event_id }}">
						<button type="submit" class="btn btn-success">Team</button>
					</form> --}}
				</td>
				@else
				<td> Null </td>
				@endif
				<td>
					<a href="{{ route('student.cartificate',$p->event_id) }}" class="btn btn-info">Cartificate</a>
				</td>
				{{-- <td>
					<a href="{{ route('student.score',[$p->event_id,$p->team_id]) }}" class="btn btn-info">Score</a>
				</td> --}}
				
			</tr>
			@endforeach
			@else
			<tr><td colspan="10"><h1>No Event Found</h1></td></tr>
			@endif
		</table>
	</div>
		{{ $participant->links() }}
	</div>
</section>
@endsection