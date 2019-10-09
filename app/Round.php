<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = ['name','description','contest_id', 'round_order'];

    public function contest() {
        return $this->belongsTo('App\Contest');
    }

    public function contestants() {
        return $this->hasMany('App\Contestant')->orderBy('order');
    }

    public function getNextRoundAttribute() {
        return static::where('round_order', $this->round_order + 1)
            ->where('contest_id', $this->contest_id)->first();
    }

    public function getPreviousRoundAttribute() {
        return static::where('round_order', $this->round_order - 1)
            ->where('contest_id', $this->contest_id)->first();
    }

    public function getNextCriteriaNumberAttribute() {
        $count = Criteria::where('round_id', $this->id)->count();
        return ++$count;
    }

    public function getNextContestantNumberAttribute() {
        $count = Contestant::where('round_id', $this->id)->count();
        return ++$count;
    }

    public function criterias() {
        return $this->hasMany('App\Criteria')->orderBy('order');
    }
}
