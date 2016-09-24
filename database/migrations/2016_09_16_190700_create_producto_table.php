<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',20);
            $table->string('unidad',20);
            $table->double('costo');
            $table->double('precio');
            $table->integer('estado');
            $table->integer('cantidad');
            //llave foranea de tipoProducto
            $table->integer('id_tipoProducto')->unsigned();
            $table->foreign('id_tipoProducto')->references('id')->on('tipoProducto');
            //llave foranea de proveedor
            $table->integer('id_proveedor')->unsigned();
            $table->foreign('id_proveedor')->references('id')->on('proveedor'); 
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
        Schema::drop('producto');
    }
}
