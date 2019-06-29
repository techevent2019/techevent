@extends('layouts.collegeadmin')

@section('content')
<section class="content-header">
   <h1>
    Events
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('collegeadmin.dashbord')}}"><i class="fa fa-dashboard"></i> admin </a></li>
        <li><a href="{{ route('collegeadmin.event.index') }}"> Events </a></li>
        <li class="active"> Winners Of Events</li>
    </ol>
</section>
<div class="page-header">
    <h1>Winner Details
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('collegeadmin.event.winner') }}" method="get" >
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
            @endif
<div ></div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
    <tr>
        
        <th>ID</th>
        <th>Event Name</th>
        <th>Participants Name</th>
        <th>Enrollment No.</th>
        <th>Email</th>
        <th>Contact No.</th>
        <th>College Name</th>
        <th>College Code</th>
        <th>Gender</th>
        <th>Score Round 1</th>
        <th>Score Round 2</th>
        <th>Score Round 3</th>
        <th>Winner</th>
        <th>Team Detail</th>
    </tr>
    @if(count($participants))
    @foreach($participants as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->event_name }}</td>
        <td>{{ $p->stu_name }}</td>
        <td>{{ $p->enrollment_no }}</td>
        <td>{{ $p->email }}</td>
        <td>{{ $p->stu_con_no }}</td>
        <td>{{ $p->stu_col_name }}</td>
        <td>{{ $p->stu_col_code }}</td>
        <td>{{ $p->stu_gender }}</td>
        <td>{{ $p->round1score }}</td>
        <td>{{ $p->round2score }}</td>
        <td>{{ $p->round3score }}</td>
        <td>{{ $p->winner }}'st position</td>
        <?php
            $max =  $p->max_member;
            $min =  $p->min_member;
            $team_id = $p->stu_enrollment_no?>
            @if ($min > 1)
           
            <td>
                 <a href="{{ route('collegeadmin.event.teamdetail',[$p->event_id, $p->stu_enrollment_no]) }}" class="btn btn-info">Team</a>
            </td>
            @else
            <td> Null </td>
            @endif
        
    </tr>
    @endforeach
    @else
    <tr><td colspan="10"><h1>No Winner Found</h1></td></tr>
    @endif
</table>
</div>
{{ $participants->appends(['ss' => $s])->links() }}
@endsection