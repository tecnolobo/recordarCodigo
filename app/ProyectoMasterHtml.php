<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoMasterHtml extends Model
{
    protected $table= "proyecto_master_htmls";
	protected $primarykey= "id";
    public $timestamps  = true;

    /*Con esta bariable protegida la pasamos los campos que podran ser rellenado de la base de datos*/
    protected $fillable = [
        'nombre','html','css','php',
        'javascript','jquery','id_categoria',
        'updated_at','id_categoria','descripsion','created_at',
    ];//

    protected $dates = ['created_at', 'updated_at', 'date'];

}
