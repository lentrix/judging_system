<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function contests() {
        return $this->hasMany('App\Contest');
    }

    public function contestJudges() {
        return $this->hasMany('App\ContestJudge');
    }

    public static function list() {
        $users = static::orderBy('name')->get();
        $data = [];
        foreach($users as $user) {
            $data[$user->id] = $user['name'];
        }
        return $data;
    }
}
