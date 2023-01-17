<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pit extends Model
{
    public function pump() {
        return $this->belongsTo('App\Pump')->withDefault();
    }

    public function calibration() {
        return $this->belongsTo('App\Calibration')->withDefault();
    }
}
