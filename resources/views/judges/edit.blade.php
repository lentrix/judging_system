@extends('layouts.main')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/contest/' . $contestJudge->contest_id)}}">{{$contestJudge->contest->title}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Judge</li>
    </ol>
</nav>

<h1>Edit Judge</h1>

<div class="row">

    <div class="col-md-4">
        @include('layouts.messages')

        {!! Form::model($contestJudge->user, ['url'=>"/judge/$contestJudge->id", 'method'=>'patch']) !!}

        <div class="form-group">
            {{Form::label('name')}}
            {{Form::text('name',null,['class'=>'form-control','required'])}}
        </div>

        <div class="form-group">
            {{Form::label('username')}}
            {{Form::text('username',null,['class'=>'form-control','required'])}}
        </div>

        <div class="form-group">
            {{Form::label('password')}}
            {{Form::password('password',['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <button class="btn btn-primary float-right" type="submit">Update Judge</button>
        </div>


        {!! Form::close() !!}
    </div>
</div>

@stop
