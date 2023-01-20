<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Werfuser extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    public function werf()
    {
        return $this->belongsTo('App\Werf')->withDefault();
    }
}
