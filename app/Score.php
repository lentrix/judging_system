<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['contest_judge_id','criteria_id','contestant_id','score'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function contestant() {
        return $this->belongsTo('App\Contestant');
    }

    public function criteria() {
        return $this->belongsTo('App\Criteria');
    }

    public static function createOrUpdate($contest_judge_id, $cont_id, $crit_id, $scoreValue) {
        $score = static::where('contest_judge_id', $contest_judge_id)
                ->where('contestant_id', $cont_id)
                ->where('criteria_id', $crit_id)->first();

        if($score) {
            $score->update([
                'score'=>$scoreValue
            ]);
        }else {
            Score::create([
                'contest_judge_id' => $contest_judge_id,
                'contestant_id' => $cont_id,
                'criteria_id' => $crit_id,
                'score' => $scoreValue
            ]);
        }
    }

    public static function get($contest_judge_id, $contestant_id, $criteria_id) {
        $score = static::where('contest_judge_id', $contest_judge_id)
                    ->where('contestant_id', $contestant_id)
                    ->where('criteria_id', $criteria_id)->first();
        $theScore = $score ? $score->score : 0;
        return $theScore;
    }

    public static function contestantJudgeTotal($contestant_id, $contest_judge_id) {
        $scores = static::where('contest_judge_id', $contest_judge_id)->where('contestant_id', $contestant_id)->get();
        $sum = 0;
        foreach($scores as $score) {
            $sum += $score->score;
        }
        return $sum;
    }

    public static function totalAndRank($round_id, $contest_judge_id) {
        $round = Round::find($round_id);
        $totals = [];
        $totalAndRank= [];
        foreach($round->contestants as $contestant) {
            $totals[$contestant->name] = Score::contestantJudgeTotal($contestant->id, $contest_judge_id);
        }

        foreach($totals as $contestant=>$total) {
            $totalAndRank[$contestant] = ['total'=>$total, 'rank'=>static::getRank($total, $totals)];
        }

        return $totalAndRank;
    }

    public static function getRank($score, Array $scores, $highestToLowest=true) {
        if($highestToLowest)
            rsort($scores);
        else
            sort($scores);

        foreach($scores as $key=>$s) {
            if($s==$score) return $key+1;
        }
    }
}
