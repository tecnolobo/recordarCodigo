<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiCuentaDePaginaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mi_cuenta_de_pagina', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_pagina', 100);
            $table->string('url');
            $table->string('usuario', 150);
            $table->longText('descripsion');
            $table->integer('id_categoria')->index();
            $table->timestamps();
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mi_cuenta_de_pagina');
    }
}
