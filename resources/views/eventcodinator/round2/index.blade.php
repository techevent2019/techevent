@extends('layouts.eventcodinator')
@section('content')
<section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('eventcodinator.dashbord') }}"><i class="fa fa-dashboard"></i>Participants</a></li>
        <li class="active">Round 2</li>
    </li>
</ol>
</section>
<div class="page-header">
<h1>Participants Details For Round 2
<div class="col-md-4" style="float: right;">
    <form action="{{ route('eventcodinator.round2.index') }}" method="get" >
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
<div class="row">
    <a href="{{ route('eventcodinator.notificationforselectedinround2')}}" class="btn btn-success">Send Notification selected in Round 2</a>
<a href="{{ route('eventcodinator.notificationforround2')}}" class="btn btn-success">Send Notification Round 2 is Started</a>
<br><br>
<a href="{{ route('eventcodinator.round2.addround3') }}" class="btn btn-info">Add to Round 3</a>
<a href="{{ route('eventcodinator.round2.choosewinner') }}" class="btn btn-info">Choose Winner</a>
</div>
</br></br>
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
    <th>Score Round 1</th>
    <th>Select Participant That Compete</th>
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
    <td>
        @if(!$p->round1score == '')
        {{ $p->round1score }}
        @else
        0
        @endif
    </td>
    <td>
        <div class="form-group">
            <form action="{{ route('eventcodinator.round2.battle_2') }}" method="get">
                <input type="checkbox" value="{{ $p->id }}" name="competeforround2[]">
            </div>
        </td>
    </tr>
    @endforeach
    @else
    <tr><td colspan="10"><h1>No Participents Left </h1></td></tr>
    @endif
</table>
</div>
@if(count($participants))
<div class="form-group">
    <input type="submit" class="btn btn-info" value="Battel">
</form></div>

@endif
{{ $participants->appends(['ss' => $s])->links() }}
@endsection