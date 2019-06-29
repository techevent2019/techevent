@if(Auth::guard('web')->check())
	<P class="text-success">
		you are logged in as a <strong>Admin</strong>
	</P>
@else
	<P class="text-danger">
		you are logged out as a <strong>Admin</strong>
	</P>
@endif

@if(Auth::guard('collegeadmin')->check())
	<P class="text-success">
		you are logged in as a <strong>College Admin</strong>
	</P>
@else
	<P class="text-danger">
		you are logged out as a <strong>College Admin</strong>
	</P>
@endif

@if(Auth::guard('hod')->check())
	<P class="text-success">
		you are logged in as a <strong>Hod</strong>
	</P>
@else
	<P class="text-danger">
		you are logged out as a <strong>Hod</strong>
	</P>
@endif

@if(Auth::guard('eventcodinator')->check())
	<P class="text-success">
		you are logged in as a <strong>evaent codinator</strong>
	</P>
@else
	<P class="text-danger">
		you are logged out as a <strong>event codinator</strong>
	</P>
@endif

@if(Auth::guard('student')->check())
	<P class="text-success">
		you are logged in as a <strong>Student</strong>
	</P>
@else
	<P class="text-danger">
		you are logged out as a <strong>Student</strong>
	</P>
@endif




