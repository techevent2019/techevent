@extends('layouts.student')

@section('content')
</br></br>
<div class="page-header">
    <h1>Plese Select You Team Member
    <div class="col-md-4" style="float: right;">
        <form action="{{ route('student.selectteammember',$id) }}" method="get" >
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
<div ></div>

<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Participants Name</th>
        <th>Enrollment No.</th>
        <th>Add to Your Team</th>
    </tr>
    @if(count($team))
    @foreach($team as $t)
    <tr>
        <td>{{ $t->id }}</td>
        <td>{{ $t->stu_name }}</td>
        <td>{{ $t->stu_enrollment_no }}</td>
        <td>
            <form action="{{ route('student.storemember',$id) }}" method="get">
                
                <input type="hidden" name="stu_name" value="{{ $t->stu_name }}"/>
                <input type="hidden" name="stu_enrollment_no" value="{{ $t->stu_enrollment_no }}"/>
                <input type="hidden" name="email" value="{{ $t->email }}"/>
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </td>
    </tr>
    @endforeach
    @else
    <tr><td colspan="10"><h1>No Student Found</h1></td></tr>
    @endif
</table>

{{ $team->appends(['s' => $s])->links() }}
@endsection