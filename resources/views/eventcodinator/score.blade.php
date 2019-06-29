@extends('layouts.eventcodinator')
@section('content')
<section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Participants Score </a></li>
    </ol>
</section>
<div class="page-header">
    <h1>Participants Score Details
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('eventcodinator.score') }}" method="get" >
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
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Participants Name</th>
            <th>Enrollment No.</th>
            <th>Score Round 1</th>
            <th>Score Round 2</th>
            <th>Score Round 3</th>
            <th>Selected in Round 2</th>
            <th>Selected in Round 3</th>
            <th>Action</th>
        </tr>
        @if(count($participants))
        @foreach($participants as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->stu_name }}</td>
            <td>{{ $p->enrollment_no }}</td>
            
            <form method="get" action="{{ route('eventcodinator.update',$p->id) }}">
                <td style="width: 150px;">
                    <input type="number" name="round1score" class="form-control" value="{{ $p->round1score}}">
                </td>
                <td style="width: 150px;">
                    <input type="number" name="round2score" class="form-control" value="{{ $p->round2score}}">
                </td>
                <td style="width: 150px;">
                    <input type="number" name="round3score" class="form-control" value="{{ $p->round3score}}">
                </td>
                <td>
                    <input type="checkbox" name="addedinround2"
                    @if($p->addedinround2 == '1')
                    checked >
                    @endif
                </td>
                <td>
                    <input type="checkbox" name="addedinround3"
                    @if($p->addedinround3 == '1')
                    checked >
                    @endif
                </td>
                <td>
                    <input type="submit" class="btn btn-info" value="Update">
                    {{-- <a href="{{route('eventcodinator.edit',$p->id) }}" class="btn btn-info">Save</a> --}}
                </td>
            </form>
            {{-- <td>{{ $p->present }}</td> --}}
        </tr>
        @endforeach
        @else
        <tr><td colspan="10"><h1>No Participat Found</h1></td></tr>
        @endif
    </table>
</div>
{{ $participants->appends(['ss' => $s])->links() }}
@endsection