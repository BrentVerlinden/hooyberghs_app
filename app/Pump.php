<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pump extends Model
{
    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function sensor() {
        return $this->belongsTo('App\Sensor')->withDefault();
    }

    public function pit() {
        return $this->belongsTo('App\Pit')->withDefault();
    }

    public function powerconsumption()
    {
        return $this->hasMany('App\Powerconsumption');
    }

    public function flowrate()
    {
        return $this->hasMany('App\Flowrate');
    }
}
