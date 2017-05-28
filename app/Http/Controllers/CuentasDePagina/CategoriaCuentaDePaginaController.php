<?php

namespace App\Http\Controllers\CuentasDePagina;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//se hace uso de los modelos
use App\CategoriaCuentaDePagina as Categoria;
use DB;

class CategoriaCuentaDePaginaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->ajax()) {

           $categoria = new Categoria;

           //verificar que se guardo el dato correctamente
           try{

                $id_ultimo=$categoria::create([
                'nombre'=>ucwords($request->nombre)
                ])->id;

                $ms="Se a agragado el dato correctamente";
            
           }catch(\Exeption $e){

                $ms="Algo salio mal" + $e;
           }
           //fin verificar
           

           return response()->json(array('ms'=>$ms, 'nombre'=>$request->nombre,'last_id'=>$id_ultimo));
            

        }else{

            return die("no es peticion ajax");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }



     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()) {

            $CCDP=Categoria::find($request->id);
            
            if(is_null($CCDP)){

                
                return response()->json(array('ms'=>'Hubo un error. esta categoria ya no existe','estado'=>1));


            }else{

                $CCDP->delete();
                return response()->json(array('ms'=>'Se elimino correctamente','estado'=>0, 'id'=>$request->id));

            }

           
        }else{

            return die("no es peticion ajax");
        }

    }

}
