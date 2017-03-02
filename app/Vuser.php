<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\AdminBuilder;

class Vuser extends Model
{
    use AdminBuilder;

    protected $fillable = [
        'vcat_id',
        'province_id',
        'name',
        'post',
        'mobile',
        'code',
        'company',
        'has_attend',
        'salesman_id',
        'regional_manager_id',
        'is_need_sms',
        'has_sms',
        'hotel',
        'gravatar',
    ];

}
