@extends('layouts.main')

@section('content')

<div class="jumbotron">
    <h1>Welcome!</h1>
    <p>{{auth()->user()->name}}</p>
</div>

<a href="{{url('/contest/create')}}" class="btn btn-primary float-right">Create Contest</a>

@include('contests._list')

@stop
