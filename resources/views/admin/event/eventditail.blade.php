@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Events
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i> admin </a></li>
        <li><a href="{{ route('admin.event.index') }}"> Events </a></li>
        <li class="active">Event Detail</li>
    </ol>
</section>

<div class="container" style="background-color: skyblue; margin-bottom: 8px; margin-top: 0px;">
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
        <label style="color: red;">last Registration date : </label><b style="color: orange;"> {{ date('d-M-y', strtotime($event->event_last_registration_date)) }}  </b>
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

    </div> <!-- panel group -->
    </div> <!--  container-->
    @endsection