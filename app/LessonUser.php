<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LessonUser extends Pivot
{
    public function getOptionsAttribute($value)
    {
    	return json_decode($value);
    }
}