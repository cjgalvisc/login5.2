<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //
    protected $table='compra';
    protected $fillable = ['cantidad','subtotal','id_facturaCompra','id_producto'];

    //hace referencia a la raelacion 1-n con la tabla factura compra
    public function faturaCompra(){
        return $this->belongsTo(FacturaCompra::class);
    }
    //hace referencia a la raelacion 1-n con la tabla producto
    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
