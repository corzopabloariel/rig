<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        "user_id",
        "email"
    ];

    /**
     * @return model
     */
    public function user() {
        return $this->belongsTo("App\User", "user_id");
    }
}
