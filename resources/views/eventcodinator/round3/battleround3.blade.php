@extends('layouts.eventcodinator')

@section('content')
<section class="content-header">
   <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('eventcodinator.dashbord') }}"><i class="fa fa-dashboard"></i>Participants</a></li>
        <li><a href="{{ route('eventcodinator.round3.index') }}">Round 3</a></li>
        <li class="active">Battel of Round 3</li>
      </ol>
</section>
<div class="page-header">
    <h1>Battel Of Round 3
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('eventcodinator.round3.battle_3') }}" method="get" >
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
        <th>Participants Name</th>
        <th>Enrollment No.</th>
        <th>Email</th>
        <th>Contact No.</th>
        <th>College Name</th>
        <th>College Code</th>
        <th>Score Round 3</th>
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
            <form action="{{ route('eventcodinator.round3.round3score') }}" method="get">
               <input type="number" name="round3score[]" style="width: 70px;" 
                    @if(!$p->round3score == '')
                        value="{{ $p->round3score }}"
                    @else
                        value="0" 
                    @endif
                required>
            
                <input type="hidden" name="id[]" value="{{ $p->id }}">
        </td>
    </tr>
    @endforeach
    @else
    <tr><td colspan="10"><h1>No Participrnts Found</h1></td></tr>
    @endif
</table>
</div>
    <input type="submit" class="btn btn-info" value="Add Score">
    </form>
</div>
</div>

{{ $participants->appends(['ss' => $s])->links() }}
@endsection