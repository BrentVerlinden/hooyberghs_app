<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{
    public function pit() {
        return $this->belongsTo('App\Pit')->withDefault();
    }
}
