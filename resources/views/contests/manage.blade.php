@extends('layouts.main')

@section('content')

@include('rounds.modal_entry')

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
                            <a href='{{url("/round/$round->id/down")}}' class="btn btn-success btn-sm" title="Move Down">&gt;</a>
                            <a href='{{url("/round/$round->id/up")}}' class="btn btn-success btn-sm" title="Move Up">&lt;</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card">
            <div class="card-header"><h3>Judges</h3></div>
            <div class="card-body">

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
