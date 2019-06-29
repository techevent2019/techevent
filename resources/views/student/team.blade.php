@extends('layouts.student')

@section('content')
</br></br>
<div class="page-header">
    <h1>Your Team Member
    {{-- <div class="col-md-4" style="float: right;">
        <form action="{{ route('student.team') }}" method="get" >
            <div class="input-group">
                <input type="text" class="form-control" name="s"
                placeholder="Search Student" value="{{ isset($s) ? $s : '' }}">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form></br>
    </div> --}}
    </h1>
</div>
<h4>Minimum team member required is {{$event->first()->min_member}}</h4>
<h4>Maximum team member required is {{$event->first()->max_member}}</h4>
@if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success')}}</p>
                </div>
                @elseif(\Session::has('alert'))
                <div class="alert alert-danger">
                    <p>{{ \Session::get('alert')}}</p>
                </div>
            @endif
<div ></div>

<div style="overflow-x:auto;">
<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Participants Name</th>
        <th>Enrollment No.</th>
        <th>Remove Form Team</th>
        <th>Accept</th>
    </tr>
    @foreach($team as $t)
    <tr>
        <td>{{ $t->id }}</td>
        <td>{{ $t->stu_name }}</td>
        <td>{{ $t->stu_enrollment_no }}</td>
        <td>
            <a href="{{route('student.destroy',[$t->id, $id,$t->stu_enrollment_no]) }}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
            {{-- <form action="{{ route('student.destroy',$t->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE"/>
                <input type="hidden" name="event_id" value="{{$id}}">
                <input type="hidden" name="enrollment_no" value="{{$t->stu_enrollment_no}}">
                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
            </form> --}}
        </td>
        <td><?php if(($t->accept) == '1'){ ?> Accept
            <?php } else { ?>  Null <?php }?></td>
        {{-- <form action="{{ route('student.storeforteam') }}" method="get"> --}}
{{--             
            <input type="hidden" name="id[]" value="{{$t->id }}"> --}}
    </tr>
    @endforeach  
</table>
</div>

<a href="{{route('student.selectteammember',$id) }}" class="btn btn-info">Select Your Tema Member </a>
<br><br>
<form action="{{ route('student.storeforteam') }}" method="get">
    <input type="hidden" name="event_id" value="{{$t->event_id }}">
    <input type="hidden" name="purpose" value="{{$event->first()->event_name}}">
    <input type="hidden" name="amount" value="{{$event->first()->evetn_price}}">
    <button type="submit" class="btn btn-success">Register</button>
</form>
{{ $team->links() }}
@endsection