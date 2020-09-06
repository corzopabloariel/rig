<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        "email"
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','email_user')
            ->withPivot('user_id','id');
    }
}
