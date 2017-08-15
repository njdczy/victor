<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\AdminBuilder;
class Salesman extends Model
{
    use AdminBuilder;

    public function vusers()
    {
        return $this->hasMany(Vuser::class,'salesman_id');
    }
}
