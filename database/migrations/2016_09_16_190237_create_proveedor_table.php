<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula',10);
            $table->string('nombre',20);
            $table->string('apellido',20); 
            //$table->date('fechaNacimiento');
            //$table->string('direccion',50);
            $table->string('telefono',10);
            $table->string('empresa',20);
            $table->integer('estado');
            $table->string('nit',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('proveedor');
    }
}
