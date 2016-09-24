<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('cantidad');
            $table->double('subtotal');
            //llave foranea de facturaCompra
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('producto');
            //llave foranea de facturaCompra
            $table->integer('id_facturaCompra')->unsigned();
            $table->foreign('id_facturaCompra')->references('id')->on('facturaCompra');
            /*//llave foranea de proveedor
            $table->integer('id_proveedor')->unsigned();
            $table->foreign('id_proveedor')->references('id')->on('proveedor');*/
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
        Schema::drop('compra');
    }
}
