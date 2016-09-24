<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
	protected $table='tienda';
	protected $fillable = ['nombre','fecha_creacion','dueño','direccion','telefono','nit'];


}
