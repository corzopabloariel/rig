<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statement extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        "operation_id",
        "user_id",
        "data",
        "obs"
    ];

    protected $casts = [
        "data" => "array"
    ];

    public function operation() {
        return $this->belongsTo('App\Operation' , 'operation_id');
    }

    public function user() {
        return $this->belongsTo('App\User' , 'user_id');
    }
}
