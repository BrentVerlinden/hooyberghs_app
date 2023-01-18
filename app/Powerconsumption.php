<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Powerconsumption extends Model
{
    public function pump() {
        return $this->belongsTo('App\Pump')->withDefault();
    }
}
