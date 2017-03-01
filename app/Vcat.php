<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class Vcat extends Model
{
    use ModelTree, AdminBuilder;

    protected $fillable = [
        'parent_id',
        'title',
        'order',
    ];
}
