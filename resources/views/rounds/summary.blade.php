@extends('layouts.main')

@section('content')

<h1 class="no-print">
    Manage Round
</h1>
<p class="no-print">
    <a href='{{url("/contest/{$round->contest->id}")}}'>{{$round->contest->title}}</a> |
    <a href='{{url("/round/$round->id")}}'>{{$round->name}}</a> | Summary
</p>
<hr class="no-print">

<div class="print-only">
    <h2>{{$round->contest->title}} Tabulation Summary | {{$round->name}}</h2>
</div>

<div class="row">

    @if($round->nextRound!=null)
    {!! Form::open(['url'=>"/round/$round->id/advance", 'method'=>'post','style'=>'width: 100%']) !!}
    @endif

    <table class="table table-bordered">
        <thead class="bg-info text-dark center">
            <tr>
                <th rowspan="2">Contestant</th>
                @foreach($round->contest->contestJudges as $contestJudge)
                <th colspan="2">{{$contestJudge->user->name}}</th>
                @endforeach
                <th rowspan="2">Sum of Ranks</th>
                <th rowspan="2">Unified Rank</th>
                @if($round->nextRound!=null)
                <th rowspan="2">
                    Qualify <br>
                    [ <a href="#" id="selectall">Check all</a> ]
                </th>
                @endif
            </tr>
            <tr>
                @foreach($contestJudges as $contestJudge)
                <th>Total</th><th>Rank</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($round->contestants as $index=>$contestant)
            <?php $rank = \App\Score::getRank($sumsOfRanks[$contestant->name],$sumsOfRanksSorted, false); ?>
            <tr @if($rank<=3) class="green-bkg" @endif>
                <td>{{$index+1}}. {{$contestant->name}}</td>

                @foreach($contestJudges as $contestJudge)

                <td class="center">{{$totalsAndRanks[$contestJudge->id][$contestant->name]['total']}}</td>
                <td class="center">
                    {{$totalsAndRanks[$contestJudge->id][$contestant->name]['rank']}}
                </td>

                @endforeach()

                <td class="center">{{$sumsOfRanks[$contestant->name]}}</td>
                <td class="center">
                    @if($rank<4) <strong> @endif
                    {{$rank}}
                    @if($rank<4) </strong> @endif
                </td>
                @if($round->nextRound != null)
                <td class="center">
                    <input type="checkbox" name="qualifier[]" value="{{$contestant->id}}" class="qualifier">
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($round->nextRound != null)
        <button class="btn btn-success float-right" type="submit">Proceed to Next Round</button>
    {!! Form::close() !!}
    @else
    <a href='{{url("/round/$round->id/close")}}' class="btn btn-warning no-print float-right">Close Contest</a>
    @endif

</div>

<div class="row print-only" style="margin-top: 40px">
    @foreach($round->contest->contestJudges as $contestJudge)
        <div class="col" style="text-align: center">
            <u style="text-transform: uppercase">{{$contestJudge->user->name}}</u><br>
            <i>Judge</i>
        </div>
    @endforeach
</div>

@stop

@section('scripts')

<script>
$(document).ready(function(){
    $("#selectall").click(function(){
        if($(this).html()=="Check all") {
            $(".qualifier").prop('checked', true)
            $(this).html("Uncheck all")
        }else {
            $(".qualifier").prop('checked', false)
            $(this).html("Check all")
        }

    })
})
</script>

@stop
