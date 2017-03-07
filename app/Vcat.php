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

    public function setOptionsAttribute($options)
    {
        if (is_array($options)) {
            $this->attributes['options'] = join(',', $options);
        }
    }

    public function getOptionsAttribute($options)
    {
        if (is_string($options)) {
            return explode(',', $options);
        }

        return $options;
    }
}
