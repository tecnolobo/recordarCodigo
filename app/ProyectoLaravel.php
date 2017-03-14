<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoLaravel extends Model
{
    protected $table= "proyecto_laravels";
	protected $primarykey= "id";
    public $timestamps  = true;

    /*Con esta bariable protegida la pasamos los campos que podran ser rellenado de la base de datos*/
    protected $fillable = [
        'nombre','descripsion','modelo','vista',
        'controlador','created_at',
    ];//

    protected $dates = ['created_at', 'updated_at', 'date'];


}
