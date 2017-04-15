<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaCuentaDePagina extends Model
{
  

 protected $table = 'categoria_cuenta_de_paginas';
 protected $fillable = ['id', 'nombre'];
}
