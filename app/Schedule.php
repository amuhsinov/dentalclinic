<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'user_id', 'date', 'time', 'patient_name', 'patient_phone_number', 'patient_email',
    ];
}
