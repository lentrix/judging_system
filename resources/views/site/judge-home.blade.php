@extends('layouts.main')

@section('content')

<h1>Judging Module</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>Contests</h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach(auth()->user()->contestJudges as $cj)
                    <a class="list-group-item list-group-item-action"
                            href='{{url("/judging/$cj->contest_id")}}'>
                        <strong>{{$cj->contest->title}}</strong><br>
                        <span class="small-italic">
                            {{$cj->contest->schedule}} |
                            {{$cj->contest->venue}}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop
