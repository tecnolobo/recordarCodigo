<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiCuentaDePagina extends Model
{
    protected $table= "mi_cuenta_de_pagina";
	protected $primarykey= "id";
    public $timestamps  = true;

    /*Con esta bariable protegida la pasamos los campos que podran ser rellenado de la base de datos*/
    protected $fillable = [
        'nombre_pagina','url','usuario','descripsion'
    ];//

    protected $dates = ['created_at', 'updated_at', 'date'];
}
