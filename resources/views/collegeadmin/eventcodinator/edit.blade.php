@extends('layouts.collegeadmin')

@section('content')

<section class="content-header">
    <h1>
        Add Event Codinator
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('collegeadmin.dashbord')}}"><i class="fa fa-dashboard"></i>college admin </a></li>
        <li class="active">Add Event Codinator</li>
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
        <form action="{{ route('collegeadmin.eventcodinator.update',$id) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <h1> Edit1 Event Codinator</h1>

                <div class="form-group">
                    <label for="event_name">Event Name</label>
                    <select name="event_name" class="form-control">
                        <option value="">Choose Event Name</option>
                            @foreach($events as $ev)
                            <option value="{{ $ev->event_name }}"

                                <?php if ($ev->id == $eventcodinators->event_id): ?>
                                    selected
                                <?php endif ?>

                                >{{ $ev->event_name }}</option>
                            @endforeach
                    </select>
                </div>


                <div class="form-group">
                     <label for="ec_name">Event Codinator Name</label>
                     <input type="text" name="stu_name" class="form-control" value="{{ $eventcodinators->stu_name }}"  readonly/>
                </div>

                <div class="form-group">
                     <label for="email">EventCodinator Email</label>
                     <input type="text" name="email" class="form-control" value="{{ $eventcodinators->email }}" readonly />
                </div>

                <div class="form-group">
                     <label for="ec_enrollment_no">Enrollment No.</label>
                     <input type="text" name="ec_enrollment_no" class="form-control" value="{{ $eventcodinators->ec_enrollment_no }}"  readonly/>
                </div>

                <div class="form-group">
                     <label for="ec_con_no">EventCodinator Contacet No.</label>
                     <input type="text" name="ec_con_no" class="form-control" value="{{ $eventcodinators->stu_con_no }}"  readonly/>
                 </div>

                 <div class="form-group">
                     <label for="col_code">EventCodinator College Code</label>
                     <input type="text" name="col_code" class="form-control" value="{{ $eventcodinators->ec_col_code }}" readonly />
                 </div>

                <div class="form-group">
                     <label for="ec_department">EventCodinator Department</label>
                     <input type="text" name="ec_department" class="form-control" value="{{ $eventcodinators->stu_department }}" readonly />
                 </div>

                <div class="form-group">
                     <label for="ec_sem">EventCodinator Semester</label>
                     <input type="number" name="ec_sem" class="form-control" value="{{ $eventcodinators->stu_sem }}" readonly/>
                </div>

                <div class="form-group">
                     <label for="ec_gender">Eventcodinator Gender</label>
                     <input type="text" name="ec_gender" class="form-control" value="{{ $eventcodinators->stu_gender }}"readonly/>
                </div>

                @method('PUT')
                <input class="btn btn-primary" type="submit" placeholder="update" />

            </form>
        </div>
    </div>
@endsection