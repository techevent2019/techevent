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
        <li class="active">Add to Round 1</li>
        </li>
      </ol>
</section>
<div class="page-header">
    <h2>Participants Details That Participated in Event
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('eventcodinator.round1.addround2') }}" method="get" >
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
        <th>Selected for Round 2</th>
        <th>Action</th>
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
            <input type="checkbox"
            @if($p->addedinround2 == '1')
            checked
            @endif readonly>
        </td>
        <td>
            <form action="{{ route('eventcodinator.round1.addinround2') }}" method="get">
                <input type="hidden" name="enrollment_no" value="{{ $p->id }}">
                <input type="submit" class="btn btn-success" value="Add in Round 2">
            </form>
        </td>
    </tr>
    @endforeach
    @else
    <tr><td colspan="10"><h1>No Participents Found </h1></td></tr>
    @endif
</table>
</div>
{{ $participants->appends(['ss' => $s])->links() }}
@endsection