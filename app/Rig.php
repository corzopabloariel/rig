<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rig extends Model
{
    protected $table = "rig";
    protected $fillable = [
        'images',
        'text',
        'captcha'
    ];

    protected $casts = [
        'images' => 'array',
        'text' => 'array',
        'captcha' => 'array'
    ];
}
