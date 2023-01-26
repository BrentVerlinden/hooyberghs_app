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



    public function logs() {
        return $this->hasMany('App\Log');
    }


}
