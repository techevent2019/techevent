@extends('layouts.collegeadmin')

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
        <li><a href="{{route('collegeadmin.dashbord')}}"><i class="fa fa-dashboard"></i> College admin </a></li>
        <li><a href="{{ route('collegeadmin.event.index') }}"> Events </a></li>
        <li><a href="{{ route('collegeadmin.event.display') }}">Display Events </a></li>
        <li class="active">Edit Events</li>
    </ol>
</section>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <form action="{{ route('collegeadmin.event.update',$id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <h1> Update your Data</h1>

                <div class="form-group">
                     <label for="event_name">Event Name</label>
                     <input type="text" name="event_name" class="form-control {{ $errors->has('event_name') ? ' is-invalid' : '' }}" value="{{ $events->event_name }}" required autofocus placeholder="Enter Event Name" />

                     @if ($errors->has('event_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('event_name') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group">
                     <label for="event_start_date">Event Start Date</label>
                     <input type="date" name="event_start_date" class="form-control {{ $errors->has('event_start_date') ? ' is-invalid' : '' }}" value="{{ $events->event_start_date }}" required autofocus />

                     @if ($errors->has('event_start_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('event_start_date') }}</strong>
                        </span>
                    @endif
                    
                </div>
                <div class="form-group">
                     <label for="event_end_date">Event End Date</label>
                     <input type="date" name="event_end_date" class="form-control {{ $errors->has('event_end_date') ? ' is-invalid' : '' }}" value="{{ $events->event_end_date }}" required autofocus />

                    @if ($errors->has('event_end_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('event_end_date') }}</strong>
                        </span>
                    @endif
                    
                </div>

                <div class="form-group">
                     <label for="event_last_registration_date">Last Registration Date for Event</label>
                     <input type="date" name="event_last_registration_date" class="form-control {{ $errors->has('event_last_registration_date') ? ' is-invalid' : '' }}" value="{{ $events->event_last_registration_date }}" required autofocus />

                    @if ($errors->has('event_last_registration_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('event_last_registration_date') }}</strong>
                        </span>
                    @endif

                     {{-- @if ($errors->has('event_last_registration_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('event_last_registration_date') }}</strong>
                        </span>
                    @endif     --}}
                </div>

                <div class="form-group">
                     <label for="event_start_time">Event Start Time</label>
                     <input type="time" name="event_start_time" class="form-control {{ $errors->has('event_start_time') ? ' is-invalid' : '' }}" value="{{ $events->event_start_time }}" required autofocus />

                     @if ($errors->has('event_start_time'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('event_start_time') }}</strong>
                        </span>
                    @endif
                    
                </div>
                <div class="form-group">
                     <label for="event_end_time">Event End Time</label>
                     <input type="time" name="event_end_time" class="form-control {{ $errors->has('event_end_time') ? ' is-invalid' : '' }}" value="{{ $events->event_end_time }}" required autofocus />

                     @if ($errors->has('event_end_time'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('event_end_time') }}</strong>
                        </span>
                    @endif
                    
                </div>
                <div class="form-group">
                     <label for="event_place">Event Place</label>
                     <input type="text" name="event_place" class="form-control {{ $errors->has('event_place') ? ' is-invalid' : '' }}" value="{{ $events->event_place }}" required autofocus placeholder="Enter Event Place"/>

                     @if ($errors->has('event_place'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('event_place') }}</strong>
                        </span>
                    @endif
                    
                </div>

                <div class="form-group">
                     <label for="techfest_name">TechFest Name</label>
                     <input type="text" name="techfest_name" class="form-control {{ $errors->has('techfest_name') ? ' is-invalid' : '' }}" value="{{ $events->techfest_name }}" required autofocus placeholder="Enter Event Place"/>

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

                            <option value="{{ $events->level }}"
                                    selected> {{ $events->level }}

                            <option value="College">College Level</option>
                    <option value="Zonal">Zonal Level</option>
                    <option value="State">Inter-College/University(State Level)</option>
                    <option value="National">Inter-College/University(National Level)</option>
                    <option value="International">International Level</option>
                        </select>
                </div> 

                <div class="form-group">
                     <label for="col_cod">College Code</label>
                     <input type="number" name="col_cod" class="form-control {{ $errors->has('col_cod') ? ' is-invalid' : '' }}" value="{{ $events->col_cod }}" required autofocus placeholder="Enter College Code" readonly />

                     @if ($errors->has('col_cod'))
                        <span class="invalid-feedback" role="alert">
                            <strong >{{ $errors->first('col_cod') }}</strong>
                        </span>
                    @endif
                    
                </div>
        
                {{-- <div class="form-group">
                     <label for="e_c_id">Event Codinator Id</label>
                     <input type="number" name="e_c_id" class="form-control {{ $errors->has('e_c_id') ? ' is-invalid' : '' }}" value="{{ $events->e_c_id }}" required autofocus placeholder="Enter Event Codinator Id" />

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

                            <option value="{{ $events->department }}"
                                    selected> {{ $events->department }}

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
                <input type="number" name="evetn_price" class="form-control {{ $errors->has('evetn_price') ? ' is-invalid' : '' }}" value="{{ $events->evetn_price }}" required autofocus placeholder="Enter Event Place"/>
                @if ($errors->has('evetn_price'))
                <span class="invalid-feedback" role="alert">
                    <strong >{{ $errors->first('evetn_price') }}</strong>
                </span>
                @endif      
            </div>

            <div class="form-group">
                <label>Team Member</label>
                <div class="row">
                    <h4 class="col-md-10">Min: <input type="number" name="min_member" value="{{ $events->min_member }}" autofocus/>
                    {{-- @if (\Session::has('min_member'))
                    <span class="invalid-feedback" role="alert">
                        <strong >{{ \Session::get('min_member') }}</strong>
                    </span>
                    @endif --}}
                    
                    Max: <input type="number" name="max_member" value="{{ $events->max_member }}" autofocus/>
                    {{-- @if (\Session::has('max_member'))
                    <span class="invalid-feedback" role="alert">
                        <strong >{{\Session::get('max_member') }}</strong>
                    </span>
                    @endif --}}

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
                    <input type="file" name="image" value="{{ $events->image }}"/>
                    @if($events->image)
                            <img src="{{ asset('public/storage/events/'.$events->image) }}" style="width: 150px;"/>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description" >Description</label>
                    <textarea name="description" class="form-control" value="{{ $events->description }}">{{ $events->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="team_specification" >Team Specification</label>
                    <textarea name="team_specification" class="form-control" value="{{ $events->team_specification }}">{{ $events->team_specification }}</textarea>
                </div>

                <div class="form-group">
                    <label for="general_rules" >General Rules</label>
                    <textarea name="general_rules" class="form-control" value="{{ $events->general_rules }}">{{ $events->general_rules }}</textarea>
                </div>

                <div class="form-group">
                    <label for="judging_criteria" >Judging Criteria</label>
                    <textarea name="judging_criteria" class="form-control" value="{{ $events->judging_criteria }}">{{ $events->judging_criteria }}</textarea>
                </div>

                <div class="form-group">
                    <label for="level_description" >Level Description</label>
                    <textarea name="level_description" class="form-control" value="{{ $events->level_description }}">{{ $events->level_description }}</textarea>
                </div>

                @method('PUT')
            <input class="btn btn-primary" type="submit" placeholder="Update Data" />

            <div><input type="hidden" name="college_name" class="form-control" value="{{ $events->college_name }}" ></div>
            <div><input type="hidden" name="college_address" class="form-control" value="{{ $events->college_name }}" ></div>
            <div><input type="hidden" name="city" class="form-control" value="{{ $events->college_name }}" ></div>
            </form>
        </div>
    </div>
@endsection