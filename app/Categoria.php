<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $table= "categorias";
	protected $primarykey= "id";
    public $timestamps  = true;

    /*Con esta bariable protegida la pasamos los campos que podran ser rellenado de la base de datos*/
    protected $fillable = [
        'nombre',
        'imagen',
        'descripsion'
    ];//

    public function proyectoMasterHtml(){
    	return $this->hasMany('app\ProyectoMasterHtml','id');
    }

    public function proyectoLaravel(){
        return $this->hasMany('app\ProyectoLaravel','id');
    }
}
