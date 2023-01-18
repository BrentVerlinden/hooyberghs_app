<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flowrate extends Model
{
    public function pump() {
        return $this->belongsTo('App\Pump')->withDefault();
    }
}
