@extends('layouts.student')
@section('content')

@if(\Session::has('success'))
          <script>
            alert(" {{\Session::get('success')}} ");
          </script>
      @endif

<div class="dropup" style="position: fixed; display: block; right: 0; bottom: 0;
  z-index: 900;  width: 100%;   max-width: 600px;">
  
  <button class="btn btn-default dropdown-toggle"  type="button" data-toggle="dropdown" style="width: 100%; max-width: 600px; background-color: #BCDEFF;">{{ isset($ss) ? $ss : 'All' }}
  <span class="caret"></span></button>
  <ul class="dropdown-menu" style="width: 100%; text-align: center;">
    <form action="{{ route('student.index') }}" method="get" >
      <li><button type="submit"><input name="ss" type="hidden"
      value="">All</button></li>
      <li class="divider"></li>
    </form>
    <form action="{{ route('student.index') }}" method="get" >
      <li><button type="submit"><input name="ss" type="hidden"
      value="computer">Computer</button></li>
      <li class="divider"></li>
    </form>
    <form action="{{ route('student.index') }}" method="get" >
      <li><button type="submit"><input name="ss" type="hidden"
      value="civil">Civil</button></li>
      <li class="divider"></li>
    </form>
    <form action="{{ route('student.index') }}" method="get" >
      <li><button type="submit"><input name="ss" type="hidden"
      value="mechanical">Mechanical</button></li>
      <li class="divider"></li>
    </form>
    <form action="{{ route('student.index') }}" method="get" >
      <li><button type="submit"><input name="ss" type="hidden"
      value="Electrical">Electrical</button></li>
      <li class="divider"></li>
    </form>
    <form action="{{ route('student.index') }}" method="get" >
      <li><button type="submit"><input name="ss" type="hidden"
      value="chemical">Chemical</button></li>
      <li class="divider"></li>
    </form>
    <form action="{{ route('student.index') }}" method="get" >
      <li><button type="submit"><input name="ss" type="hidden"
      value="others">others</button></li>
    </form>
  </ul>
  
</div>
<div class="container" style="margin-bottom: 8px;margin-top: 51px;">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" style="width:100%;">
      </div>
      <div class="item">
        <img src="https://images.unsplash.com/photo-1520110120835-c96534a4c984?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1047&q=80" style="width:100%;">
      </div>
      
      <div class="item">
        <img src="https://images.unsplash.com/photo-1510511233900-1982d92bd835?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="New york" style="width:100%;">
      </div>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<!--  Events -->
@if(count($events))
@foreach($events->chunk(3) as $eventChunk)
<div class="row">
  @foreach($eventChunk as $event)
  <a href="{{ route('student.event',$event->id) }}">
  <div  class="col-sm-6 col-md-4">
    <div class="thumbnail">
      
        <img class="card-img-top img-fluid" src="{{ asset('public/storage/events/'.$event->image) }}" alt="Card image cap";>
      
      <div class="card-body" style="margin:8px;">
        <div>
          <label style="font-size: 32px; color: grey; justify-content: center;" ><b>{{$event->event_name}}</b></label>
        </div>
        <div>
          <p><h3>{{ $event->college_name }}</h3><b style="margin-right: 3px; float: right; text-align: right; color: skyblue;"> Event Date: {{ date('d-M-y', strtotime($event->event_start_date)) }}</b></p>
        </div>
        <div>
          <label style="color: grey;">{{ $event->city }}</label>
        </div>
        <div>
          <label>last Registration date :</label>
          {{ date('d-M-y', strtotime($event->event_last_registration_date)) }}
        </div>
      </div>
    </div>
  </div>
  </a>
  @endforeach
</div>
@endforeach
@else
      <tr><td colspan="10"><h1>No Events Found</h1></td></tr>
      @endif
 {{ $events->appends(['ss' => $ss])->links() }}
@endsection