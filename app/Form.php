<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        "order",
        "type",
        "name",
        "data",
        "required"
    ];

    protected $casts = [
        "data" => "array",
        "required" => "boolean"
    ];

    public function printForm() {
        return "";
    }
}
