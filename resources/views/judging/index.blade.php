@extends('layouts.main')

@section('content')

@if($contest->status=="pending")

<div class="jumbotron">
    <h1>{{$contest->title}}</h1>
    <p>This contest is currently pending. Please just refresh this page when the contest commences.</p>
</div>

@else

@include('layouts.messages')

<h1>{{$contest->title}} | {{$contest->currentRound->name}}</h1>
<p>Judge: {{auth()->user()->name}}</p>
<hr>
<form method="post" action='{{url("/judging/{$contest->currentRound->id}")}}'>
    {{csrf_field()}}
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Contestant</th>
            @foreach($contest->currentRound->criterias as $crit)
            <th>
                {{$crit->criteria}} ({{$crit->max}})<br>
                <span class="small-italic">{{$crit->description}}</span>
            </th>
            @endforeach
            <th>Total*</th>
            <th>Rank*</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contest->currentRound->contestants as $cont)
        <tr>
            <td><strong>{{$cont->name}}</strong></td>
            @foreach($contest->currentRound->criterias as $crit2)
            <td>
                <input type="number"
                        name="score[{{$cont->id}}][{{$crit2->id}}]"
                        class="form-control score-entry"
                        data-max="{{$crit2->max}}"
                        value="{{\App\Score::get(auth()->user()->id, $cont->id, $crit2->id)}}">
            </td>
            @endforeach
            <td>{{$totalAndRank[$cont->name]['total']}}</td>
            <td>{{$totalAndRank[$cont->name]['rank']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
<button class="btn btn-primary btn-lg float-right">Save Scores</button>
<p class="small-italic">Note: * Total and Rank will be updated only after the save button is clicked.</p>
</form>
<br><br>
@endif

@stop


@section('scripts')
<script>
$(document).ready(function(){
    $(".score-entry").blur(function(){
        var max = $(this).attr('data-max')*1;
        var score = $(this).val()*1;

        if(score > max) {
            alert('The score ' + score + ' is greater than the maximum ' + max + '. The score has been truncated to max value.');
            $(this).val(max);
        }
    })
})
</script>
@stop
