<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    public function day() {
    	return $this->hasOne('App\Day', 'day_id');
    }
}
