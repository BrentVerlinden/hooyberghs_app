<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public $timestamps = false;
    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function pump() {
        return $this->belongsTo('App\Pump')->withDefault();
    }

    public function calibration() {
        return $this->belongsTo('App\Sensor')->withDefault();
    }


}
