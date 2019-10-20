<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestJudge extends Model
{
    protected $fillable = ['user_id', 'contest_id', 'order'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function contest() {
        return $this->belongsTo('App\Contest');
    }

    public function getNextJudgeAttribute() {
        return static::where('order', $this->order + 1)->first();
    }

    public function getPreviousJudgeAttribute() {
        return static::where('order', $this->order - 1)->first();
    }

    public function scores() {
        return $this->hasMany('App\Score');
    }
}
