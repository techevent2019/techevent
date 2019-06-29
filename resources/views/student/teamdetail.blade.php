@extends('layouts.student')

@section('content')
</br></br>
<div class="page-header">
    <h1>Your Team Member</h1>
</div>

<div style="overflow-x:auto;">
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