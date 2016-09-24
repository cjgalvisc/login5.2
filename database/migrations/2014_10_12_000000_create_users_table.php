<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula',10);
            $table->string('name',20);
            $table->string('apellidos',20); 
            $table->date('fechaNacimiento');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('direccion',50);
            $table->string('telefono',10);
            $table->integer('rol')->unsigned();
            $table->foreign('rol')->references('id')->on('rol');
            $table->rememberToken();
            $table->integer('estado');
            $table->date('fechaIngreso');
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
        Schema::drop('users');
    }
}
