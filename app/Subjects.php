<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';

    public function document()
    {
    	return $this->hasMany('App\Documents', 'id_subject', 'id');
    }
}
