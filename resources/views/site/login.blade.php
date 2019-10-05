@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3>User Login</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['url'=>'/login', 'method'=>'post']) !!}

                <div class="form-group">
                    {{Form::label('username')}}
                    {{Form::text('username',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('password')}}
                    {{Form::password('password',['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary float-right" type="submit">Login</button>
                </div>

                {!! Form::close(); !!}
            </div>
        </div>
        @include('layouts.messages')
    </div>
</div>

@stop
