@extends('layouts.main')

@section('content')

@include('rounds.modal_entry')

@include('judges.modal_entry')

@include('judges.modal_confirm_delete')

@include('rounds.modal_confirm_delete')

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
                            <button class="btn btn-danger btn-sm delete-round-btn"
                                    data-target="{{$round->id}}"
                                    data-name="{{$round->name}}">X</button>
                            <a href='{{url("/round/$round->id/up")}}' class="btn btn-success btn-sm" title="Move Up">&lt;</a>
                            <a href='{{url("/round/$round->id/down")}}' class="btn btn-success btn-sm" title="Move Down">&gt;</a>
                            <a href='{{url("/round/$round->id")}}' class="btn btn-sm btn-info" title="Manage Round">^</a>
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
                            <button class="btn btn-danger btn-sm delete-btn"
                                    data-target="{{$contestJudge->id}}"
                                    data-name="{{$contestJudge->user->name}}">X</button>
                            <a href='{{url("/judge/$contestJudge->id/up")}}'
                                class="btn btn-success btn-sm">&lt;</a>
                            <a href='{{url("/judge/$contestJudge->id/down")}}'
                                class="btn btn-success btn-sm">&gt;</a>
                            <a href='{{url("/judge/$contestJudge->id/edit")}}' class="btn btn-info btn-sm" title="Edit Judge">E</a>
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

    $('.delete-btn').click(function() {
        var targetID = $(this).attr('data-target');
        var judgeName = $(this).attr('data-name');
        console.log(judgeName);
        $("#judge_name").text(judgeName);
        $("#contest_judge_id").val(targetID);
        $("#deleteJudgeModal").modal('show');
    })

    $('.delete-round-btn').click(function(){
        var roundID = $(this).attr('data-target');
        var roundName = $(this).attr('data-name');
        console.log(roundID, roundName);

        $("#round_id").val(roundID);
        $("#round_name").text(roundName);
        $("#deleteRoundModal").modal('show');

    })

})
</script>

@stop
