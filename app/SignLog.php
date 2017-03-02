<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignLog extends Model
{
    public function vusers()
    {
        return $this->hasMany('App\Vuser');
    }
}
