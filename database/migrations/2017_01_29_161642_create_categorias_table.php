<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id_categoria');
            $table->string('nombre');
            $table->jsonb('tipos_archivos');
            $table->longText('descripsion');
            $table->string('imagen');
            /*$table->integer('id_tipo_noticia')->index();
            $table->integer('id_user')->index();aqui le decimos q sera un indice para refrerenciar otra tabla*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categorias');
    }
}
