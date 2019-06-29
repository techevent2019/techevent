@extends('layouts.admin')
@section('content')
<style>
strong {
color: red;
}
</style>
<section class="content-header">
  <h1>
  Events
  <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i> admin </a></li>
    <li><a href="{{ route('admin.event.index') }}"> Events </a></li>
    <li class="active">Add Events</li>
  </ol>
</section>
<div class="page-header">
  <h1>Add Event to calander</h1>
</div>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="event_name">Event Name</label>
        <input type="text" name="event_name" class="form-control {{ $errors->has('event_name') ? ' is-invalid' : '' }}" value="{{ old('event_name') }}" required autofocus placeholder="Enter Event Name" />
        @if ($errors->has('event_name'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('event_name') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="event_start_date">Event Start Date</label>
        <input type="date" name="event_start_date" class="form-control {{ $errors->has('event_start_date') ? ' is-invalid' : '' }}" value="{{ old('event_start_date') }}" required autofocus />
        @if ($errors->has('event_start_date'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('event_start_date') }}</strong>
        </span>
        @endif
        
      </div>
      <div class="form-group">
        <label for="event_end_date">Event End Date</label>
        <input type="date" name="event_end_date" class="form-control {{ $errors->has('event_end_date') ? ' is-invalid' : '' }}" value="{{ old('event_end_date') }}" required autofocus />
        @if ($errors->has('event_end_date'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('event_end_date') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="event_last_registration_date">Last Registration Date for Event</label>
        <input type="date" name="event_last_registration_date" class="form-control {{ $errors->has('event_last_registration_date') ? ' is-invalid' : '' }}" value="{{ old('event_last_registration_date') }}" required autofocus />
        @if (\Session::has('event_last_registration_date'))
        <span class="invalid-feedback" role="alert">
          <strong >{{\Session::get('event_last_registration_date') }}</strong>
        </span>
        @endif
        @if ($errors->has('event_last_registration_date'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('event_last_registration_date') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="event_start_time">Event Start Time</label>
        <input type="time" name="event_start_time" class="form-control {{ $errors->has('event_start_time') ? ' is-invalid' : '' }}" value="{{ old('event_start_time') }}" required autofocus />
        @if ($errors->has('event_start_time'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('event_start_time') }}</strong>
        </span>
        @endif
        
      </div>
      <div class="form-group">
        <label for="event_end_time">Event End Time</label>
        <input type="time" name="event_end_time" class="form-control {{ $errors->has('event_end_time') ? ' is-invalid' : '' }}" value="{{ old('event_end_time') }}" required autofocus />
        @if ($errors->has('event_end_time'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('event_end_time') }}</strong>
        </span>
        @endif
      </div>
      
      <div class="form-group">
        <label for="event_place">Event Place</label>
        <input type="text" name="event_place" class="form-control {{ $errors->has('event_place') ? ' is-invalid' : '' }}" value="{{ old('event_place') }}" required autofocus placeholder="Enter Event Place"/>
        @if ($errors->has('event_place'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('event_place') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-group">
        <label for="techfest_name">TechFest Name</label>
        <input type="text" name="techfest_name" class="form-control {{ $errors->has('techfest_name') ? ' is-invalid' : '' }}" value="{{ old('techfest_name') }}" required autofocus placeholder="Enter TechFest Name"/>
        @if ($errors->has('techfest_name'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('techfest_name') }}</strong>
        </span>
        @endif
        
      </div>
      <div class="form-group">
        <label for="level">Event Level</label>
        <select name="level" class="form-control" value="{{ old('level') }}" required>
          <option value="">Choose Event Level</option>
          <option value="College">College Level</option>
          <option value="Zonal">Zonal Level</option>
          <option value="State">Inter-College/University(State Level)</option>
          <option value="National">Inter-College/University(National Level)</option>
          <option value="International">International Level</option>
        </select>
      </div>
      <div class="form-group">
        <label for="col_cod">College Code</label>
        <input type="text" name="col_cod" class="form-control {{ $errors->has('col_cod') ? ' is-invalid' : '' }}" value="{{ old('col_cod') }}" required autofocus placeholder="Enter College Code"/>
        @if ($errors->has('col_cod'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('col_cod') }}</strong>
        </span>
        @endif
      </div>
      
      {{-- <div class="form-group">
        <label for="e_c_id">Event Codinator Id</label>
        <input type="number" name="e_c_id" class="form-control {{ $errors->has('e_c_id') ? ' is-invalid' : '' }}" value="{{ old('e_c_id') }}" required autofocus placeholder="Enter Event Codinator Id"/>
        @if ($errors->has('e_c_id'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('e_c_id') }}</strong>
        </span>
        @endif
        
      </div> --}}
      <div class="form-group">
        <label for="department">Department</label>
        <select name="department" class="form-control" value="{{ old('department') }}" required>
          <option value="">Choose Department</option>
          <option value="computer">Computer</option>
          <option value="civil">Civil</option>
          <option value="mechanical">Mechanical</option>
          <option value="electrical">Electrical</option>
          <option value="chemical">Chemical</option>
          <option value="others">others</option>
        </select>
      </div>
      <div class="form-group">
        <label for="evetn_price">Event Price</label>
        <input type="number" name="evetn_price" class="form-control {{ $errors->has('evetn_price') ? ' is-invalid' : '' }}" value="{{ old('evetn_price') }}" required autofocus placeholder="Enter Event Place"/>
        @if ($errors->has('evetn_price'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('evetn_price') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="college_name">College Name</label>
        <input type="text" name="college_name" class="form-control {{ $errors->has('college_name') ? ' is-invalid' : '' }}" value="{{ old('college_name') }}" required autofocus placeholder="Enter College Name"/>
        @if ($errors->has('college_name'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('college_name') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="college_address">College Address</label>
        <input type="text" name="college_address" class="form-control {{ $errors->has('college_address') ? ' is-invalid' : '' }}" value="{{ old('college_address') }}" required autofocus placeholder="Enter College Address"/>
        @if ($errors->has('college_address'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('college_address') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="city">College City</label>
        <input type="text" name="city" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ old('city') }}" required autofocus placeholder="Enter City"/>
        @if ($errors->has('city'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('city') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label>Team Member</label>
        <div class="row">
          <h4 class="col-md-10">Min: <input type="number" name="min_member" value="{{ old('min_member') }}" />
          
          Max: <input type="number" name="max_member" value="{{ old('max_member') }}" />
          </h4>
        </div>
        @if ($errors->has('min_member'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('min_member') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('max_member'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('max_member') }}</strong>
                        </span>
                    @endif   
      </div>
      <div class="form-group">
        <label for="image">image</label>
        <input type="file" name="image" value="{{ old('image') }}" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" value="" placeholder="Enter description of Event">{{ old('description') }}</textarea>
        @if ($errors->has('description'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('description') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="team_specification">Team Specification</label>
        <textarea name="team_specification" class="form-control{{ $errors->has('team_specification') ? ' is-invalid' : '' }}" value="" placeholder="Enter team specification of Event">{{ old('team_specification') }}</textarea>
        @if ($errors->has('team_specification'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('team_specification') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="general_rules">General Rules</label>
        <textarea name="general_rules" class="form-control{{ $errors->has('general_rules') ? ' is-invalid' : '' }}" value="" placeholder="Enter General Rules of Event">{{ old('general_rules') }}</textarea>
        @if ($errors->has('general_rules'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('general_rules') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="judging_criteria">Judging Criteria</label>
        <textarea name="judging_criteria" class="form-control{{ $errors->has('judging_criteria') ? ' is-invalid' : '' }}" value="" placeholder="Enter judging criteria of Event">{{ old('judging_criteria') }}</textarea>
        @if ($errors->has('judging_criteria'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('judging_criteria') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group">
        <label for="level_description">Level Description</label>
        <textarea name="level_description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" value="" placeholder="Enter level description of Event">{{ old('level_description') }}</textarea>
        @if ($errors->has('level_description'))
        <span class="invalid-feedback" role="alert">
          <strong >{{ $errors->first('level_description') }}</strong>
        </span>
        @endif
      </div>
      <input class="btn btn-primary" type="submit" placeholder="Add Event2 Data" />
    </form>
  </div>
</div>
@endsection