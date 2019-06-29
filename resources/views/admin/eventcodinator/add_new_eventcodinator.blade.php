@extends('layouts.admin')
@section('content')
<?php   $str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmlnopqrstuvwxyz";
$str = str_shuffle($str);
$str = substr($str, 0, 9);
?>
<section class="content-header">
    <h1>
    Add Event Codinator
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.admin')}}"><i class="fa fa-dashboard"></i> admin </a></li>
        <li><a href="{{route('admin.eventcodinator.index')}}"> Event Codinator </a></li>
        <li><a href="{{route('admin.eventcodinator.display')}}">Add Event Codinator</a></li>
        <li class="active">Add As Event Codinator</li>
    </ol>
</section>
@if(\Session::has('danger'))
</br>
<div class="alert alert-danger">
    <p>{{ \Session::get('danger')}}</p>
</div>
@endif
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="{{ route('admin.eventcodinator.store',$id) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h1> Add Event Codinator</h1>
            <div class="form-group">
                <label for="event_name">Event Name</label>
                <select name="event_name" class="form-control">
                    <option value="">Choose Category</option>
                    @foreach($events as $e)
                    <option value="{{ $e->event_name }}">{{ $e->event_name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="event_id">Event Id</label>
                <select name="event_id" class="form-control">
                    <option value="">Choose Category</option>
                    @foreach($events as $e)
                    <option value="{{ $e->id }}">{{ $e->id }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="ec_name">Event Codinator Name</label>
                <input type="text" name="ec_name" class="form-control" value="{{ $students->stu_name }}" readonly />
            </div>
            <div class="form-group">
                <label for="email">Event Codinator Email</label>
                <input type="text" name="email" class="form-control" value="{{ $students->email }}" readonly />
            </div>
            <div class="form-group">
                <label for="ec_enrollment_no">Enrollment No.</label>
                <input type="text" name="ec_enrollment_no" class="form-control" value="{{ $students->stu_enrollment_no }}" readonly  />
            </div>
            <div class="form-group">
                <label for="ec_con_no">EventCodinator Contacet No.</label>
                <input type="text" name="ec_con_no" class="form-control" value="{{ $students->stu_con_no }}" readonly />
            </div>
            <div class="form-group">
                <label for="col_code">EventCodinator College Code</label>
                <input type="text" name="ec_col_code" class="form-control" value="{{ $students->stu_col_code }}" readonly />
            </div>
            <div class="form-group">
                <label for="ec_department">EventCodinator Department</label>
                <input type="text" name="ec_department" class="form-control" value="{{ $students->stu_department }}" readonly  />
            </div>
            <div class="form-group">
                <label for="ec_sem">EventCodinator Semester</label>
                <input type="number" name="ec_sem" class="form-control" value="{{ $students->stu_sem }}" readonly />
            </div>
            <div class="form-group">
                <label for="ec_gender">Eventcodinator Gender</label>
                <input type="text" name="ec_gender" class="form-control" value="{{ $students->stu_gender }}" readonly />
            </div>
            <input class="btn btn-primary" type="submit" placeholder="Add Event Codinator" />
            <div class="col-md-6"><input type="hidden" name="password" class="form-control" value="{{ $str }}" ></div>
        </form>
    </div>
</div>
@endsection