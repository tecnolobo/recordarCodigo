<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectosMaster extends Model
{
    protected $table= "proyectos_master";
	protected $primarykey= "id";
    public $timestamps  = true;

    /*Con esta bariable protegida la pasamos los campos que podran ser rellenado de la base de datos*/
    protected $fillable = [
        "nombre","descripsion","colum_1","colum_2","colum_3","colum_4","colum_5",
        "colum_6","colum_7","colum_8","colum_9","colum_10","id_categoria","created_at",
        "updated_at",
    ];//

    protected $dates = ['created_at', 'updated_at', 'date'];
}
