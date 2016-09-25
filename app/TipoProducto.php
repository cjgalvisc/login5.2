<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    //
    protected $table='tipoProducto';
	protected $primarykey='id';
    protected $fillable = ['id','nombre','estado'];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
