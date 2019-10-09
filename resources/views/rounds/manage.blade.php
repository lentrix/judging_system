@extends('layouts.main')

@section('content')

@include('criterias.modal_entry')
@include('contestants.modal_entry')

@if($round->contest->status == $round->id)
<span class="float-right" style="width: 500px">
    <div class="alert alert-info">
        This contest is now on-going...
        <a href='{{url("/round/$round->id/summary")}}' class="btn btn-primary float-right">View Summary</a>
    </div>
</span>

@endif

<h1>Manage Round</h1>
<p><a href='{{url("/contest/{$round->contest->id}")}}'>{{$round->contest->title}}</a> | {{$round->name}}</p>
<hr>

@include('layouts.messages')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary float-right modal-btn" data-target="addCriterionModal">+</button>
                <h3>Criteria</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php $total = 0; ?>
                    @foreach($round->criterias as $criteria)
                        <?php $total += $criteria->max; ?>
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
                            <a href='{{url("/criteria/$criteria->id/up")}}' class="btn btn-success btn-sm">&lt;</a>
                            <a href='{{url("/criteria/$criteria->id/down")}}' class="btn btn-success btn-sm">&gt;</a>
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer">
                <h3>
                    TOTAL
                    <span class="float-right">
                        <strong>{{$total}}</strong>
                    </span>
                </h3>
            </div>
        </div>

    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                    <button class="btn btn-primary float-right modal-btn" data-target="addContestantModal">+</button>
                <h3>Contestants</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($round->contestants as $contestant)

                    <li class="list-group-item">
                        <strong>{{$contestant->order}}. {{$contestant->name}}</strong>
                        @if($contestant->details)
                            <br><span class="small-italic">{{$contestant->details}}</span>
                        @endif
                        <hr>
                        <span class="float-right">
                            {{Form::open(['url'=>"/contestant/$contestant->id",'method'=>'delete','style'=>'display:inline'])}}
                                <button class="btn btn-danger btn-sm" title="Delete contestant">X</button>
                            {{Form::close()}}
                            <a href='{{url("/contestant/$contestant->id/up")}}' class="btn btn-success btn-sm">&lt;</a>
                            <a href='{{url("/contestant/$contestant->id/down")}}' class="btn btn-success btn-sm">&gt;</a>
                        </span>
                    </li>

                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>

@if($round->contest->status != $round->id)
<hr>
<div class="row">
    <div class="col-md-3 offset-md-9">
        <a href='{{url("/round/$round->id/commence")}}' class="btn btn-primary btn-lg float-right">
            Commence Round
        </a>
    </div>
</div>
@else
<hr>
<div class="row">
    <div class="col-md-3 offset-md-9">
        <a href='{{url("/round/$round->id/suspend")}}' class="btn btn-warning btn-lg float-right">
            Suspend Round
        </a>
    </div>
</div>
@endif

<br><br>
@stop

@section('scripts')

<script>
$(document).ready(function(){
    $(".modal-btn").click(function(){
        var target = $(this).attr('data-target');
        $("#" + target).modal('show');
    })
})
</script>

@stop
