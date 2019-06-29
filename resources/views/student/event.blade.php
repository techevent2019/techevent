@extends('layouts.student')
@section('content')
{{-- @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif --}}
@if(\Session::has('alert'))
<script>
alert(" {{\Session::get('alert')}} ");
</script>
@endif
<div class="container" style="background-color: skyblue; margin-bottom: 8px; margin-top: 51px;">
  <div class="card box">
    <img class="card-img-top img-fluid" src="{{ asset('public/storage/events/'.$event->image) }}" width="100%" height="30%" style="max-height: 800px;" alt="Card image cap">
    <div class="card-body" style="margin:8px;">
      <div style="text-align: center;">
        <label style="font-size: 32px; color: grey;" ><b>{{$event->event_name}}</b></label>
      </div>
      <div>
        <h3>{{ $event->college_name }}</h3>
      </div>
      
      <div style="margin: 3px;">
        <p><b style="font-size: 20px;  color: green;">{{ date('d-M-y', strtotime($event->event_start_date)) }} - {{ date('d-M-y', strtotime($event->event_end_date)) }}</b></p>
      </div>
      <div> <label> College Address :</label><mark>{{ $event->college_address }}</mark></div>
      <div style="margin: 5px;">
        <label style="color: red;">last Registration date : </label><b style="color: orange;"> {{ date('d-M-y', strtotime($event->event_last_registration_date)) }} </b>
      </div>

      <div style="margin: 5px;">
        <label style="color: green;">Event Price: </label><b style="color: orange;"> {{ $event->evetn_price }} Rs.</b>
      </div>

      <div style="text-align: center; background-color: #FFE4E1; ">
        <label> Event Place :</label><mark>{{$event->event_place}}</mark>
      </div>
    </div>
  </div>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Event Description </a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
                      <pre>
                            <div class="panel-body" style="font: sans-serif; color:   #008B8B; font-size: 20px;">{{$event->description}}</div>
                      </div>
      </pre>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Team specification </a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
                       <pre>
                            <div class="panel-body" style="font: sans-serif; color:   #008B8B; font-size: 20px;">{{$event->team_specification}}
                    </div>
        </pre>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">General Rules</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
                     <pre>
                            <div class="panel-body" style="font: sans-serif; color:   #008B8B; font-size: 20px;">{{$event->general_rules}}</div>
        </pre>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Judging Criteria </a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
                     <pre>
                            <div class="panel-body" style="font: sans-serif; color:   #008B8B; font-size: 20px;">{{$event->judging_criteria}}</div>
                      </div>
      </pre>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Level Description</a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
                        <pre>
                            <div class="panel-body" style="font: sans-serif; color:   #008B8B; font-size: 20px;">{{$event->level_description}}</div>
                      </div>
      </pre>
    </div>
    {{-- <form method="get" action="{{ route('student.store') }}">
      <div align="center" style="margin-top: 10px;">
        <input class="btn btn-success" onclick="return clicked();" type="submit" placeholder="Add Event Data"/>
        <div><input type="hidden" name="event_id" class="form-control" value="{{ $event->id }}" ></div>
        
        <div>
          <input type="hidden" name="stu_enrollment_no" class="form-control" value="{{ $student->stu_enrollment_no }}" >
          <input type="hidden" name="email" class="form-control" value="{{ $student->email }}" >
          <input type="hidden" name="max_member" class="form-control" value="{{ $event->max_member }}" >
          <input type="hidden" name="min_member" class="form-control" value="{{ $event->min_member }}" >
        </div>
        
      </div>
    </form> --}}
      <script type="text/javascript">
      function clicked() {
      if (confirm("Are you sure to Registration Event!!")) {
      return true;
      } else {
      return false;
      }
      
      }
      </script>

      {{-- <form method="post" action="{{ route('student.createRequest') }}">
        {{ csrf_field() }}
      <div align="center" style="margin-top: 10px;">
        <input class="btn btn-success" onclick="return clicked();" type="submit" placeholder="Add Event Data"/>
        <div><input type="text" name="purpose" class="form-control" value="{{ $event->event_name }}" ></div>
        <div>
          <input type="text" name="amount" class="form-control" value="{{ $event->evetn_price }}" >
          <input type="text" name="email" class="form-control" value="{{ $student->email }}" >
          <input type="text" name="phone" class="form-control" value="{{ $student->stu_con_no }}" >
          <input type="text" name="username" class="form-control" value="{{ $student->stu_name }}" >
        </div>
        
      </div>
    </form> --}}

      <form method="get" action="{{ route('student.store') }}">
        {{ csrf_field() }}
      <div align="center" style="margin-top: 10px;">
        
        <div><input type="hidden" name="purpose" class="form-control" value="{{ $event->event_name }}" ></div>
        <div>
          <input type="hidden" name="amount" class="form-control" value="{{ $event->evetn_price }}" >
          <input type="hidden" name="email" class="form-control" value="{{ $student->email }}" >
          <input type="hidden" name="phone" class="form-control" value="{{ $student->stu_con_no }}" >
          <input type="hidden" name="username" class="form-control" value="{{ $student->stu_name }}" >
          <div><input type="hidden" name="event_id" class="form-control" value="{{ $event->id }}" ></div>
        <div>
          <input type="hidden" name="stu_enrollment_no" class="form-control" value="{{ $student->stu_enrollment_no }}" >
          <input type="hidden" name="max_member" class="form-control" value="{{ $event->max_member }}" >
          <input type="hidden" name="min_member" class="form-control" value="{{ $event->min_member }}" >
        </div>
        <input class="btn btn-success" onclick="return clicked();" type="submit" placeholder="Add Event Data" value="Submit" />
        </div>
        
      </div>
    </form>
      
      </div> <!-- panel group -->
      </div> <!--  container-->
      @endsection