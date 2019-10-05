<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    protected $fillable = ['name','details','remarks','order','round_id'];

    public function round() {
        return $this->belongsTol('App\Round');
    }

    public function getNextContestantAttribute() {
        return static::where('order', $this->order+1)->first();
    }

    public function getPreviousContestantAttribute() {
        return static::where('order', $this->order-1)->first();
    }
}
