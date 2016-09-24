<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda', function (Blueprint $table) {
            $table->String('nombre',20);
            $table->date('fecha_creacion');
            $table->String('dueño',20);
            $table->String('direccion',50);
            $table->String('telefono',10);
            $table->String('nit',10);   
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
        Schema::drop('tienda');
    }
}
