<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumIdCategoriProyectoOracleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyecto_oracle', function (Blueprint $table) {
            $table->integer('id_categoria')->after('plsql');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyecto_oracle', function (Blueprint $table) {
            $table->dropColumn('id_categoria');
        });
    }
}
