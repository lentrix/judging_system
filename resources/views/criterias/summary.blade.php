@extends('layouts.main')


@section('content')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item">
        <a href="{{url('/round/' . $criteria->round->id)}}">{{$criteria->round->name}}</a>
    </li>
    <li class="breadcrumb-item active">{{$criteria->criteria}}</li>
</ol>

<h1>Criteria Summary: {{$criteria->criteria}}</h1>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Contestant</th>
            @foreach($criteria->round->contest->contestJudges as $contestJudge)
            <th>{{$contestJudge->user->name}}</th>
            @endforeach
            <th>Total</th>
            <th>Rank</th>
        </tr>
    </thead>
    <tbody>
        @foreach($criteria->round->contestants as $contestant)
        <tr>
            <td>{{$contestant->order}}. {{$contestant->name}}</td>
            @foreach($computation[$contestant->id] as $key=>$value)
            <td>{{$value}}</td>
            @endforeach
            <td>{{\App\Score::getRank($computation[$contestant->id]['total'], $totals)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
