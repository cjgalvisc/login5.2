<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	protected $table='rol';
	protected $primarykey='id';
    protected $fillable = ['id','nombre'];

    //funncion par aestablecer la realcio con la tabla Rol
    //un rol pertenece a muchos usuarios
    public function users(){
        return $this->hasMany(User::class);
    }
    
}
