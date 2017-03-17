<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;


class Conference extends Model
{
    use AdminBuilder;
    protected $fillable;
    public function vcats()
    {
        return $this->morphToMany(Vcat::class, 'taggable', 'demo_taggables');
    }
}
