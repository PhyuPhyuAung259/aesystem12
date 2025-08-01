<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekDay extends Model
{
    //
    protected $table = 'weekdays';

    public function flighschedule(){
    	return $this->belongsToMany(FlightSchedule::class);
    }
}
