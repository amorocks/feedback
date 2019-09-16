<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function users()
    {
    	return $this->belongsToMany('App\User')
    		->using('App\LessonUser')
    		->withPivot('message', 'options')
    		->withTimestamps();
    }
}
