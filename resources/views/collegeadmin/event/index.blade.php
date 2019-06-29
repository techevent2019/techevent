@extends('layouts.collegeadmin')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<section class="content-header">
	<h1>
	Events
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('collegeadmin.dashbord')}}"><i class="fa fa-dashboard"></i> College admin </a></li>
		<li class="active">Events</li>
	</ol>
</section>
<div class="container">
	<div class="jumbotron">
		<div class="row">
			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
			
			@if(\Session::has('success'))
			<div class="alert alert-success">
				<p>{{ \Session::get('success')}}</p>
			</div>
			@endif
		</div>
		
		<a href="{{ route('collegeadmin.event.create') }}" class="btn btn-success">Add Event</a>
		<a href="{{ route('collegeadmin.event.display') }}" class="btn btn-primary">Edit Event</a>{{-- 
		<a href="{{ route('collegeadmin.event.participants') }}" class="btn btn-success">Event Participants</a>  --}}
		
		</br>
		</br>
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
				Event Calendar Example</div>
				<div class="panel-body">
					{!! $calendar->calendar() !!}
					{!! $calendar->script() !!}
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection