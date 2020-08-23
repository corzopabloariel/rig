<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "code",
        "data"
    ];
}
