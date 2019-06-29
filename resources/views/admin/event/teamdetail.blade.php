@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i> admin </a></li>
        <li><a href="{{ route('admin.event.index') }}"> Events </a></li>
        <li><a href="{{ route('admin.event.participants') }}">Participants Of Events </a> </li>
        <li class="active" > Team Member</li>
    </ol>
</section>
<div class="page-header">
    <h1>Your Team Member</h1>
</div>

<div class="table-responsive">
<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Participants Name</th>
        <th>Enrollment No.</th>
    </tr>
    @foreach($team as $t)
    <tr>
        <td>{{ $t->id }}</td>
        <td>{{ $t->stu_name }}</td>
        <td>{{ $t->enrollment_no }}</td>
    </tr>
    @endforeach  
</table>
</div>

{{ $team->links() }}
@endsection