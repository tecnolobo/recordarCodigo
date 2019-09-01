<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectProyectoOracleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_oracle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripsion',50);
            $table->longText('sql');
            $table->longText('plsql');
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
        Schema::drop('proyecto_oracle');
    }
}
