<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    public function document()
    {
    	return $this->belongsTo('App\Documents', 'id_document', 'id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
