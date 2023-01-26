<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensordata extends Model
{
    public function sensor() {
        return $this->belongsTo('App\Sensor')->withDefault();
    }
}
