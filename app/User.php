<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_id',
        'password',
        'profile',
        'tipo',
        'comitente',
        'nombre',
        'domicilio',
        'post',
        'localidad',
        'pais',
        'telefono',
        'cuit',
        'docu',
        'numero_doc',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * @var array
     */
    public static $tipo = [
        "TITU.",
        "APOD."
    ];

    public function hasRole($role)
    {//...$roles :: spread operator
        return $this->profile == $role;
    }

    public function redirect()
    {
        $elements = [
            'root' => 'root',
            'adm' => 'adm',
            'user' => 'client'
        ];
        return $elements[$this->profile];
    }

    public function emails()
    {
        return $this->belongsToMany('App\Email','email_user')
            ->withPivot('email_id','id');
    }

    public function statements()
    {
        return $this->hasMany("App\Statement", "user_id");
    }
}
