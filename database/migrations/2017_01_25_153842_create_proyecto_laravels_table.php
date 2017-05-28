<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoLaravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_laravels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripsion',50);
            $table->longText('modelo');
            $table->longText('vista');
            $table->longText('controlador');
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
        Schema::drop('proyecto_laravels');
    }
}
