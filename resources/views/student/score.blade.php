@extends('layouts.student')
@section('content')
<section class="content-header">
	
</section>
<section class="content-header" style="margin-top: 10px">
	<div class="conrainer-fluid">
		
		<h1>Score of Event</h1>
		
<div style="overflow-x:auto;">
	
		<table class="table table-bordered table-striped">
			<tr>
				<th>Event Name</th>
				<th>Round 1</th>
				<th>Round 2</th>
				<th>Round 3</th>
				<th>Winner</th>
			</tr>
			@if(count($score))
			@foreach($score as $s)
			<tr>
				<td>{{ $s->event_name }}</td>
				<td>{{ $s->round1score }}</td>
				<td>{{ $s->round2score }}</td>
				<td>{{ $s->round3score }}</td>
				<?php if($s->winner == 0)
				{
					?> <td>No</td>
				<?php }
				else{
					?><td>{{ $s->winner }}'st position</td>
					<?php
				}?>
				
				
			</tr>
			@endforeach
			@else
			<tr><td colspan="10"><h1>No Event Found</h1></td></tr>
			@endif
			
		</table>
	</div>
	</div>
	{{-- <script type="text/javascript">
    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 10000);
</script> --}}
</section>
@endsection