<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProyectoLaravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyecto_laravels', function (Blueprint $table) {
            //se campo descripsion a tipo longtext
             $table->longText('descripsion')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyecto_laravels', function (Blueprint $table) {
            // se cambia el campo descipsion a string
            $table->string('descripsion',50)->change();
        });
    }
}
