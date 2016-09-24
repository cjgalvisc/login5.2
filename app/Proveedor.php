<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table='proveedor';
	protected $primarykey='id';
    protected $fillable = ['id','cedula','nombre','apellido','telefono','empresa','estado','nit'];

    public function facturaCompra(){
        return $this->hasMany(FacturaCompra::class);
    }
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
