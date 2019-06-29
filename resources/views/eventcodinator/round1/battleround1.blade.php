@extends('layouts.eventcodinator')

@section('content')
<section class="content-header">
   <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('eventcodinator.dashbord') }}"><i class="fa fa-dashboard"></i>Participants</a></li>
        <li><a href="{{ route('eventcodinator.round1.index') }}">Round 1</a></li>
        <li class="active">Battel of Round 1</li>
      </ol>
</section>
<div class="page-header">
    <h1>Battel Of Round 1
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('eventcodinator.round1.battle_1') }}" method="get" >
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
            <form action="{{ route('eventcodinator.round1.round1score') }}" method="get">
               <input type="number" name="round1score[]" style="width: 70px;" 
                    @if(!$p->round1score == '')
                        value="{{ $p->round1score }}"
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

    <input type="submit" class="btn btn-info" value="Add Score">
    </form>

    <div class="row" style="align-self: center;">
        <div class="col-md-4 col-md-offset-4">
    <form action="{{ route('eventcodinator.round1.addinround2') }}" method="get">
@if(sizeof($participants)>1)
    <h5><b>Choose Participant that selected for Round 2</b></h5>
        <div class="form-group">
                    <label for="enrollment_no"></label>
                    @if(count($participants))
                    @foreach($participants as $p)
                        <input type="hidden" name="id[]" value="{{ $p->id }}">
                    @endforeach
                    @endif
        
                    
                    <select name="enrollment_no" class="form-control" required>
                        <option value="">Choose Enrollment No.</option>
                            @foreach($participants as $p)
                                <option value="{{ $p->id }}">{{ $p->enrollment_no }}</option>
                            @endforeach
                    </select>
                    
                </div>

        <input type="submit" class="btn btn-success" value="Add in Round 2">
    </form>
    @endif
</div>
</div>
{{ $participants->appends(['ss' => $s])->links() }}
@endsection