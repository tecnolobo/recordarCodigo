<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested..
|
*/

/*Route::get('/', function () {
    
});*/
Route::get('error',function(){ abort('404');});

Route::group(['middleware' => 'auth'], function () {

	Route::get('editarCodigo/{id}',"RecordatorioController@editHtmlMaster")->where('id','[0-9]+');
	Route::post('actualizarCodigoMasterHtml',"RecordatorioController@updateCodigoMasterHtml");
	Route::get('destroyCodigoLaravel/{id}',"RecordatorioController@destroyCodigoLaravel")->where('id','[0-9]+');
	Route::get('destroyCodigoHtml/{id}',"RecordatorioController@destroyCodigoHtml")->where('id','[0-9]+');

	//Categorias
	Route::get('categorias',"CategoriasController@index");
	Route::get('categorias/nuevo',"CategoriasController@create");
	Route::get('destroyCategoria/{id}',"CategoriasController@destroy")->where('id','[0-9]+');
	Route::post('categorias/guardarCategoria',"CategoriasController@store");
	

});

Route::get('/',"RecordatorioController@index");
Route::get('showCodigo/{id}',"RecordatorioController@show")->where('id','[0-9]+');
/*Route::get('showCodigo/{id}',"RecordatorioController@showCodeMasterHtmlProyect")->where('id','[0-9]+');
Route::get('showCodigoLaravel/{id}',"RecordatorioController@showCodigoLaravel")->where('id','[0-9]+');
*/


Route::get('/categoria/{id}',"RecordatorioController@categoria")->where('id','[0-9]+')->name('categoriaById');
Route::get('recordatorio',"RecordatorioController@create");
Route::post('guardarRecordatorio',"RecordatorioController@store");
Route::get('buscar',"RecordatorioController@buscar")->where('b',"[a-zA-z]+");
Route::get('/categoria/{id_categoria?}/buscar',"CategoriasController@BuscarPorCategoria")->where('id_categoria','[0-9]+')->where('b',"[a-zA-z]+")
->name('buscarPorCategoria');
Route::get('/cache', function () {$exitCode = Artisan::call('cache:clear');  Artisan::call('config:clear'); Artisan::call('view:clear'); });



Route::auth();

Route::get('/home', 'HomeController@index');
