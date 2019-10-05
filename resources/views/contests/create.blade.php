@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-6">
        <h1>Create Contest</h1>

        {!! Form::open(['url'=>'/contest', 'method'=>'post']) !!}

        @include('contests._form')

        {!! Form::close() !!}

    </div>
</div>

@stop
