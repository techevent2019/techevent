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
        <li class="active">choose winner</li>
        </li>
      </ol>
</section>
<div class="page-header">
    <h1>Participants Details
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('eventcodinator.round3.choosewinner') }}" method="get" >
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
        <th>Score Round 1</th>
        <th>Score Round 2</th>
        <th>Score Round 3</th>
        <th>Choose Winner</th>
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
            @if(!$p->round2score == '')
                {{ $p->round2score }}
            @else
                0
            @endif
        </td>

        <td>
            @if(!$p->round3score == '')
                {{ $p->round3score }}
            @else
                0
            @endif
        </td>
        
        <td>
            <form action="{{ route('eventcodinator.round3.winner') }}" method="get">
                <input type="hidden" name="id[]" value="{{ $p->id }}">

                <div class="form-group">
                    <select name="winner[]" class="form-control">
                        <option value="">Choose Positions</option>
                        
                            <option value="1">1'st Position</option>
                            <option value="2">2'st Position</option>
                            <option value="3">3'st Position</option>
                            
                    </select>
                </div>
        </td>
    </tr>
    @endforeach
    @else
    <tr><td colspan="10"><h1>No Participents Left </h1></td></tr>
    @endif
</table>
</div>
<div class="form-group">
                <input type="submit" class="btn btn-info" value="Save">
            </form></div>
{{ $participants->appends(['ss' => $s])->links() }}
@endsection