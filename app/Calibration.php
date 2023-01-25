<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{
    public function werf() {
        return $this->belongsTo('App\Werf')->withDefault();
    }

    public function sensors() {
        return $this->hasMany('App\Sensor');
    }
}
