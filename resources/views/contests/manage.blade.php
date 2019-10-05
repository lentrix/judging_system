@extends('layouts.main')

@section('content')

@include('rounds.modal_entry')

@include('judges.modal_entry')

<h1>{{$contest->title}}</h1>
<div class="float-right">Current Status: {{$contest->status}}</div>
<p>{{$contest->schedule}} | {{$contest->venue}}</p>
<hr>

@include('layouts.messages')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary float-right modal-btn" data-target="addRoundModal">+</button>
                <h3>Rounds</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($contest->rounds as $round)
                    <li class="list-group-item">
                        <strong>{{$round->name}}</strong><br>
                        <span class="small-italic">{{$round->description}}</span>
                        <hr>
                        <div class="float-right">
                            <a href='{{url("/round/$round->id")}}' class="btn btn-sm btn-info" title="Manage Round">^</a>
                            <a href='{{url("/round/$round->id/up")}}' class="btn btn-success btn-sm" title="Move Up">&lt;</a>
                            <a href='{{url("/round/$round->id/down")}}' class="btn btn-success btn-sm" title="Move Down">&gt;</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card">

            <div class="card-header">
                <button class="btn btn-primary float-right modal-btn"
                        title="Add Judge"
                        data-target="addJudgeModal">+</button>
                <h3>Judges</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($contest->contestJudges as $contestJudge)
                    <li class="list-group-item">
                        <strong>{{$contestJudge->order}}. {{$contestJudge->user->name}}</strong> <br>
                        <hr>
                        <div class="float-right">
                            {{Form::open(['url'=>"/judge/$contestJudge->id", 'method'=>'delete','style'=>'display: inline'])}}
                                <button class="btn btn-danger btn-sm">X</button>
                            {{Form::close()}}
                            <a href='{{url("/judge/$contestJudge->id/up")}}'
                                class="btn btn-success btn-sm">&lt;</a>
                            <a href='{{url("/judge/$contestJudge->id/down")}}'
                                class="btn btn-success btn-sm">&gt;</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>

@stop

@section('scripts')

<script>
$(document).ready(function(){
    $('.modal-btn').click(function(){
        var target = $(this).attr('data-target');
        $("#" + target).modal('show');
    })
})
</script>

@stop
