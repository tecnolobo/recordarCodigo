<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    
});*/
Route::get('error',function(){ abort('404');});

Route::get('/',"RecordatorioController@index");
Route::get('showCodigo/{id}',"RecordatorioController@show")->where('id','[0-9]+');
Route::get('showCodigoLaravel/{id}',"RecordatorioController@showCodigoLaravel")->where('id','[0-9]+');
Route::get('destroyCodigoLaravel/{id}',"RecordatorioController@destroyCodigoLaravel")->where('id','[0-9]+');
Route::get('destroyCodigoHtml/{id}',"RecordatorioController@destroyCodigoHtml")->where('id','[0-9]+');
Route::get('/categoria/{id}',"RecordatorioController@categoria")->where('id','[0-9]+');
Route::get('recordatorio',"RecordatorioController@create");
Route::post('guardarRecordatorio',"RecordatorioController@store");


/*mis Cuentas de paginas*/
Route::get('/cuentasCreadas',"CuentasDePagina\MisCuentasDePaginasController@index");
Route::get('nuevaCuentaDePagina',"CuentasDePagina\MisCuentasDePaginasController@create");
Route::post('nuevaCuentaDePagina',"CuentasDePagina\MisCuentasDePaginasController@store");
Route::get('/destroyCuentaCreada/{id}',"CuentasDePagina\MisCuentasDePaginasController@destroy")->where('id','[0-9]+');
Route::post('ajaxNewCategoria',"CuentasDePagina\CategoriaCuentaDePaginaController@store");
Route::post('destroyCateCuentaDePag',"CuentasDePagina\CategoriaCuentaDePaginaController@destroy");

