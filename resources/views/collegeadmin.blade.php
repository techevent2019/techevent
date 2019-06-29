@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">college admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="panel-body">
                        @component('components.who')
                        @endcomponent


                        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>College Name</th>
                <th>College Email</th>
                <th>College Address</th>
                <th>College Contact No.</th>
                <th>College Code</th>
                <th>College City</th>
                <th>Action</th>
            </tr>
            @if(count($collegeadmins))
            @foreach($collegeadmins as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->col_name }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->col_address }}</td>
                    <td>{{ $c->col_con_no }}</td>
                    <td>{{ $c->col_code }}</td>
                    <td>{{ $c->col_city }}</td>

                    <td>
                    
                            </form>
                    </td>
                </tr>
            @endforeach
            @else
            <tr><td colspan="3">No Category Found</td></tr>
            @endif
        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection