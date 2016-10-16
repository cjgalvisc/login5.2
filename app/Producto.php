<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table='producto';
	protected $primarykey='id';
    protected $fillable = ['id','nombre','unidad','costo','precio','id_tipoProducto','id_proveedor','estado','cantidad'];

    public function tipoPoducto(){
        return $this->belongsTo(TipoProducto::class);
    }
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

   

}
