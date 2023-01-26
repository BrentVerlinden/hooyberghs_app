<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{

    public function sensor() {
        return $this->belongsTo('App\Sensor')->withDefault();
    }
}
