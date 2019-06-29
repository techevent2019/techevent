@extends('layouts.admin')
@section('content')

<section class="content-header">
   	<h1>
        Payments
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
	    <li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i>Collega admin </a></li>
        <li class="active">Payment Details</li>
    </ol>
</section>
<section class="content-header">
	<div class="conrainer-fluid">
	<h2>Payment Details
		
		<div class="col-md-4" style="float: right;">
	    	<form action="{{ route('admin.Paymentdetails') }}" method="get" >
	    		<div class="input-group">
	    	    <input type="text" class="form-control" name="ss" 
	            placeholder="Search Students" value="{{ isset($ss) ? $ss : '' }}"> 
	            <span class="input-group-btn">
	            	<button type="submit" class="btn btn-primary">
	                <span class="glyphicon glyphicon-search"></span>
	            	</button>
	        	</span>
	    		</div>
			</form></br>
		</div>
	</h2></div>
</section>
		@if(\Session::has('success'))
				<div class="alert alert-success">
					<p>{{ \Session::get('success')}}</p>
				</div>
			@endif
<h1>
	Total Amount = {{$totel}} Rs.
</h1>
<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Enrollment No.</th>
				<th>College Name</th>
				<th>Colege Code</th>
				<th>Event Name</th>
				<th>Event Price</th>
				<th>Payment Status</th>
				<th>Payment Id</th>
				<th>Payment Request Id</th>
				{{-- <th>Action</th> --}}
			</tr>
			@if(count($pay))
			@foreach($pay as $s)
				<tr>
					<td>{{ $s->id }}</td>
					<td>{{ $s->stu_name }}</td>
					<td>{{ $s->stu_enrollment_no }}</td>
					<td>{{ $s->college_name }}</td>
					<td>{{ $s->col_cod }}</td>
					<td>{{ $s->event_name }}</td>
					<td>{{ $s->evetn_price }}</td>
					<td>{{ $s->payment_status }}</td>
					<td>{{ $s->payment_id }}</td>
					<td>{{ $s->payment_request_id }}</td>
				</tr>
			@endforeach
			@else
			<tr><td colspan="10"><h1>No Payment Found</h1></td></tr>
			@endif
		</table></div>
		{{ $pay->appends(['ss' => $ss])->links() }}
		
		

@endsection