<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = ['criteria','description','max','round_id','order'];

    public function getNextCriteriaAttribute() {
        return static::where('order', $this->order + 1)->first();
    }

    public function getPreviousCriteriaAttribute() {
        return static::where('order', $this->order - 1)->first();
    }

    public function round() {
        return $this->belongsTo('App\Round');
    }
}
