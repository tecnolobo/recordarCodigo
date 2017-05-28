<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoMasterHtmlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_master_htmls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('descripsion',50);
            $table->longText('html');
            $table->longText('css');
            $table->longText('php');
            $table->longText('javascript');
            $table->longText('jquery');
            $table->integer('id_categoria')->index();
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
        Schema::drop('proyecto_master_htmls');
    }
}
