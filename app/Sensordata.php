<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensordata extends Model
{
    public $timestamps = false;
    public function sensor() {
        return $this->belongsTo('App\Sensor')->withDefault();
    }
}
