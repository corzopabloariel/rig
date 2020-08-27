<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $fillable = [
        'type',
        'value'
    ];

    /**
     * @var array
     */
    protected $type = [
        'email:notice',
        'email:reply',
        'email:statement',
        'paginate'
    ];
}
