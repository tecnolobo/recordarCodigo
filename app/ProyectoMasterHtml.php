<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoMaster extends Model
{
    protected $table= "proyecto_masters";
	protected $primarykey= "id";
    public $timestamps  = true;

    /*Con esta bariable protegida la pasamos los campos que podran ser rellenado de la base de datos*/
    protected $fillable = [
        'nombre',
        'descripsion',
        'id_usuario',
        'id_categoria',
        'estructura',
        'col_1',
        'col_2',
        'col_3',
        'col_4',
        'col_5',
        'col_6',
        'col_7',
        'col_8',
        'col_9',
        'col_10',
        'updated_at',
        'id_categoria',
        ,'created_at',
    ];//

    protected $dates = ['created_at', 'updated_at', 'date'];

}
