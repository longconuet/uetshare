<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents';

    public function subject()
    {
    	return $this->belongsTo('App\Subjects', 'id_subject', 'id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'id_user', 'id');
    }

    public function comment()
    {
    	return $this->hasMany('App\Comments', 'id_document', 'id');
    }
}
