@extends('layouts.main')

@section('content')

<div class="row">
    <h1>{{$round->contest->title}} ({{$round->name}}) Summary</h1>

    <table class="table table-bordered">
        <thead class="bg-info text-dark">
            <tr>
                <th rowspan="2">Contestant</th>
                @foreach($round->contest->contestJudges as $contestJudge)
                <th colspan="2">{{$contestJudge->user->name}}</th>
                @endforeach
                <th rowspan="2">Sum of Ranks</th>
                <th rowspan="2">Unified Rank</th>
            </tr>
            <tr>
                @foreach($contestJudges as $contestJudge)
                <th>Total</th><th>Rank</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($round->contestants as $index=>$contestant)
            <tr>
                <td>{{$index+1}}. {{$contestant->name}}</td>

                @foreach($contestJudges as $contestJudge)

                <td class="center">{{$totalsAndRanks[$contestJudge->id][$contestant->name]['total']}}</td>
                <td class="center">{{$totalsAndRanks[$contestJudge->id][$contestant->name]['rank']}}</td>

                @endforeach()

                <td class="center">{{$sumsOfRanks[$contestant->name]}}</td>
                <td class="center">{{\App\Score::getRank($sumsOfRanks[$contestant->name],$sumsOfRanksSorted, false)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@stop
