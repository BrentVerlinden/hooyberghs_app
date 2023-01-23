<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    public function pump() {
        return $this->belongsTo('App\Pump')->withDefault();
    }

    public function sensor() {
        return $this->belongsTo('App\Sensor')->withDefault();
    }

    public function werf() {
        return $this->belongsTo('App\Werf')->withDefault();
    }
}
