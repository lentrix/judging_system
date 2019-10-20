<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['user_id','criteria_id','contestant_id','score'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function contestant() {
        return $this->belongsTo('App\Contestant');
    }

    public function criteria() {
        return $this->belongsTo('App\Criteria');
    }

    public static function createOrUpdate($user_id, $cont_id, $crit_id, $scoreValue) {
        $score = static::where('user_id', $user_id)
                ->where('contestant_id', $cont_id)
                ->where('criteria_id', $crit_id)->first();

        if($score) {
            $score->update([
                'score'=>$scoreValue
            ]);
        }else {
            Score::create([
                'user_id' => $user_id,
                'contestant_id' => $cont_id,
                'criteria_id' => $crit_id,
                'score' => $scoreValue
            ]);
        }
    }

    public static function get($user_id, $contestant_id, $criteria_id) {
        $score = static::where('user_id', $user_id)
                    ->where('contestant_id', $contestant_id)
                    ->where('criteria_id', $criteria_id)->first();
        $theScore = $score ? $score->score : 0;
        return $theScore;
    }

    public static function contestantJudgeTotal($contestant_id, $user_id) {
        $scores = static::where('user_id', $user_id)->where('contestant_id', $contestant_id)->get();
        $sum = 0;
        foreach($scores as $score) {
            $sum += $score->score;
        }
        return $sum;
    }

    public static function totalAndRank($round_id, $user_id) {
        $round = Round::find($round_id);
        $totals = [];
        $totalAndRank= [];
        foreach($round->contestants as $contestant) {
            $totals[$contestant->name] = Score::contestantJudgeTotal($contestant->id, $user_id);
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
