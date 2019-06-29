@extends('layouts.student')
@section('content')
<div style="margin-bottom: 8px;margin-top: 51px;">
  <div style="margin-top: 3px; padding: 8px; ">
    <form action="{{ route('student.college') }}" method="get">
      <div class="input-group">
        <input type="text" name="ss" class="form-control" value="{{ isset($ss) ? $ss : '' }}" placeholder="Search..." >
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary">
          <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </form>
  </div>
</div>
@foreach($colleges->chunk(3) as $collegeChunk)
<div class="row">
  @foreach($collegeChunk as $college)
  <div  class="col-sm-6 col-md-4">
    <div class="thumbnail">

      <form action="{{ route('student.index') }}" method="get" >
        <button type="submit"><input name="ss" type="hidden"
          value="{{$college->col_code}}">
          <img class="card-img-top img-fluid" src="{{ asset('public/storage/colleges/'.$college->image) }}" alt="Card image cap"; style=" width: 200px; height: 200px">
        </button>
      </form>

      <div style="margin : 8px;">
        <h2>{{ $college->col_name }}</h2>
      </div>

    <div style="margin-top: 24px;">
      <p><label>College Address</label></br>{{ $college->col_address }}</p>
    </div>
    <div style="margin-right: 3px; text-align: right;font-size:20px; color:#5F99DB;"><label >{{ $college->col_city }}</label></div>
  </div>
</div>
@endforeach
</div>
@endforeach
@endsection