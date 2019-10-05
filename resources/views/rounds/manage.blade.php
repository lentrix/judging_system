@extends('layouts.main')

@section('content')

@include('criterias.modal_entry')

<h1>Manage Round</h1>
<p><a href='{{url("/contest/{$round->contest->id}")}}'>{{$round->contest->title}}</a> | {{$round->name}}</p>
<hr>

@include('layouts.messages')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary float-right" id="addCriterionModalButton">+</button>
                <h3>Criteria</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($round->criterias as $criteria)
                    <li class="list-group-item">
                        <span class="float-right">
                            <h3>{{$criteria->max}}</h3>
                        </span>
                        <strong>{{$criteria->criteria}}</strong><br>
                        <span class="small-italic">{{$criteria->description}}</span>
                        <hr>
                        <span class="float-right">
                            {!! Form::open(['url'=>"/criteria/$criteria->id", 'method'=>'delete','style'=>'display: inline']) !!}
                                <button class="btn btn-danger btn-sm">X</button>
                            {!! Form::close() !!}
                            <a href='{{url("/criteria/$criteria->id/down")}}' class="btn btn-success btn-sm">&gt;</a>
                            <a href='{{url("/criteria/$criteria->id/up")}}' class="btn btn-success btn-sm">&lt;</a>
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Contestants</h3>
            </div>
            <div class="card-body"></div>
        </div>
    </div>
</div>
@stop

@section('scripts')

<script>
$(document).ready(function(){
    $("#addCriterionModalButton").click(function(){
        $("#addCriterionModal").modal('show');
    })
})
</script>

@stop
