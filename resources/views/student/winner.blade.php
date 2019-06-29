@extends('layouts.student')

@section('content')
<section class="content-header">
</br></br>
</section>
<div class="page-header">
    <h1>Winner List
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('student.winner') }}" method="get" >
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

<div class="table-responsive">
<table class="table table-bordered table-striped">
    <tr>
        
        <th>ID</th>
        <th>Event College Name</th>
        <th>Event College Code</th>
        <th>Event Name</th>
        <th>Participant College Name</th>
        <th>Participants Name</th>
        <th>Enrollment No.</th>
        <th>Winner</th>
        <th>Team Detail</th>
    </tr>
    @if(count($participants))
    @foreach($participants as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->college_name }}</td>
        <td>{{ $p->col_cod }}</td>
        <td>{{ $p->event_name }}</td>
        <td>{{ $p->stu_col_name }}</td>
        <td>{{ $p->stu_name }}</td>
        <td>{{ $p->enrollment_no }}</td>
        <td>{{ $p->winner }}'st position</td>
        <?php
            $max =  $p->max_member;
            $min =  $p->min_member;
            $team_id = $p->stu_enrollment_no?>
            @if ($min > 1)
           
            <td>
                 <a href="{{ route('student.teamdetail',[$p->event_id, $p->stu_enrollment_no]) }}" class="btn btn-info">Team</a>
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