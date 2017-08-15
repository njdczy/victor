<?php


namespace App;


use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;

class Jxs extends Model
{
    use AdminBuilder;

    public function vusers()
    {
        return $this->hasMany(Vuser::class,'company');
    }
}