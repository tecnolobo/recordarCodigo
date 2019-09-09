<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('descripsion',50);
            $table->integer('id_usuario')->index();
            $table->integer('id_categoria')->index();
            $table->longText('estructura',50);
            $table->longText('col_1');
            $table->longText('col_2');
            $table->longText('col_3');
            $table->longText('col_4');
            $table->longText('col_5');
            $table->longText('col_6');
            $table->longText('col_7');
            $table->longText('col_8');
            $table->longText('col_9');
            $table->longText('col_10');
           
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
        Schema::drop('proyecto_master');
    }
}
