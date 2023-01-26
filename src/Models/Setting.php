<?php

namespace Letsgoi\LaravelSettings\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @var array */
    protected $fillable = [
        'key',
        'value',
        'type'
    ];
}
