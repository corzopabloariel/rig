<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailUser extends Model
{
    public $timestamps = false;

    protected $table = "email_user";

    protected $fillable = [
        "email_id",
        "user_id"
    ];
}
