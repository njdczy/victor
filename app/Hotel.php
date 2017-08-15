<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use AdminBuilder;

    public function vusers()
    {
        return $this->hasMany(Vuser::class,'regional_manager_id');
    }
}
