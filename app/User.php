<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function document()
    {
        return $this->hasMany('App\Documents', 'id_user', 'id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comments', 'id_user', 'id');
    }
}
