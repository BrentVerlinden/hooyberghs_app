<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Automation extends Model
{
    public $timestamps = false;

    public function werf() {
        return $this->belongsTo('App\Werf')->withDefault();
    }
}
