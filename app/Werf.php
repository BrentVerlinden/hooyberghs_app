<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Werf extends Model
{
    public function werfusers()
    {
        return $this->hasMany('App\Werfuser');
    }

    public function pumps()
    {
        return $this->hasMany('App\Pump');
    }

    public function calibration() {
        return $this->belongsTo('App\Calibration')->withDefault();
    }

    public function logs() {
        return $this->hasMany('App\Log');
    }

    public function automation() {
        return $this->belongsTo('App\Automation')->withDefault();
    }
}
