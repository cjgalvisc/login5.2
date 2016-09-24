<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cedula','name','apellidos','fechaNacimiento','email', 'password','direccion','telefono','rol','estado','fechaIngreso'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     //un User pertenece a un rol
    public function rol(){
        return $this->belongsTo(Rol::class);
    }
}
