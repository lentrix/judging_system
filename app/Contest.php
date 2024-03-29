<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $fillable = ['title', 'schedule', 'venue', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function rounds() {
        return $this->hasMany('App\Round')->orderBy('round_order');
    }

    public function getNextRoundNumberAttribute() {
        $count = \App\Round::where('contest_id', $this->id)->count();
        return ++$count;
    }

    public function getNextJudgeNumberAttribute() {
        $count = \App\ContestJudge::where('contest_id', $this->id)->count();
        return ++$count;
    }

    public function contestJudges() {
        return $this->hasMany('App\ContestJudge')->orderBy('order');
    }

    public function getRoundsCountAttribute() {
        return Round::where('contest_id', $this->id)->count();
    }

    public function getJudgesCountAttribute() {
        return ContestJudge::where('contest_id', $this->id)->count();
    }

    public function getStatusTextAttribute() {
        if($this->status != 'pending') {
            $round = Round::find($this->status);
            return $round->name;
        }else {
            return "pending";
        }
    }

    public function getCurrentRoundAttribute() {
        return Round::find($this->status);
    }
}
