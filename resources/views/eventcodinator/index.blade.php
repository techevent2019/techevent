@extends('layouts.eventcodinator')
@section('content')
<section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Participants </a></li>
    </ol>
</section>
<form action="{{ route('eventcodinator.reset') }}" method="get">
    <input type="submit" class="btn btn-info" value="reset">
</form>
<div class="page-header">
    <h1>Participants Details
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('eventcodinator.dashbord') }}" method="get" >
            <div class="input-group">
                <input type="text" class="form-control" name="ss"
                placeholder="Search Participants" value="{{ isset($s) ? $s : '' }}">
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
@if(\Session::has('success'))
<div class="alert alert-success">
    <p>{{ \Session::get('success')}}</p>
</div>
@elseif(\Session::has('alert'))
    <div class="alert alert-danger">
        <p>{{ \Session::get('alert')}}</p>
    </div>
@endif
<a href="{{ route('eventcodinator.notification')}}" class="btn btn-success">Send Notification Event is Started</a></br><br>

<div class="table-responsive">
<table class="table table-bordered table-striped">
    <tr>
        
        <th>ID</th>
        <th>Participants Name</th>
        <th>Enrollment No.</th>
        <th>Email</th>
        <th>Contact No.</th>
        <th>College Name</th>
        <th>College Code</th>
        <th>Gender</th>
        <th>Semester</th>
        <th>Team Detail </th>
        <th>Present</th>
    </tr>
    @if(count($participants))
    @foreach($participants as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->stu_name }}</td>
        <td>{{ $p->enrollment_no }}</td>
        <td>{{ $p->email }}</td>
        <td>{{ $p->stu_con_no }}</td>
        <td>{{ $p->stu_col_name }}</td>
        <td>{{ $p->stu_col_code }}</td>
        <td>{{ $p->stu_gender }}</td>
        <td>{{ $p->stu_sem }}</td>
        <?php
            $max =  $p->max_member;
            $min =  $p->min_member;
            $team_id = $p->stu_enrollment_no?>
            @if ($min > 1)
           
            <td>
                 <a href="{{ route('eventcodinator.teamdetail',[$p->event_id, $p->stu_enrollment_no]) }}" class="btn btn-info">Team</a>
                {{-- <form action="{{ route('eventcodinator.teamdetail') }}" method="get">
                        <input type="hidden" name="event_id" value="{{$p->event_id }}">
                        <input type="hidden" name="team_id" value="{{$p->stu_enrollment_no }}">
                        <button type="submit" class="btn btn-success">Team</button>
                    </form> --}}
            </td>
            @else
            <td> Null </td>
            @endif

        <td>
            <div class="form-group">
                <form action="{{ route('eventcodinator.present') }}" method="get">
                    <input type="checkbox" value="{{ $p->id }}" name="present[]"
                    @if($p->present == '1')
                    checked >
                    @endif
                </div>
            </td>

            {{-- <td>{{ $p->present }}</td> --}}
        </tr>
        @endforeach
        @else
        <tr><td colspan="10"><h1>No Event Found</h1></td></tr>
        @endif
    </table>
</div>
    @if(count($participants))
    <div class="form-group">
        <input type="submit" class="btn btn-info" value="Save">
    </div></form>
    @endif
    {{ $participants->appends(['ss' => $s])->links() }}
    @endsection