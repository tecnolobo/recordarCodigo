<?php

namespace App\Http\Controllers\CuentasDePagina;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use App\MiCuentaDePagina;


class MisCuentasDePaginasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $imagenes=DB::table('imagens')->get();

       $catCuentasDePag=DB::table('categoria_cuenta_de_paginas')->orderBy('id', 'desc')->take(5)->get();
       $catCuentasDePagt=DB::table('categoria_cuenta_de_paginas')->get();

       $todos=DB::table('mi_cuenta_de_pagina')->get();
       $resientes=DB::table('mi_cuenta_de_pagina')->orderBy('id', 'desc')->take(5)->get();
       return view('layouts.cuentasdepaginas.index',['imagenes'=>$imagenes, 'resientes'=>$resientes,'todos'=>$todos, 'catCuentasDePag' => $catCuentasDePag, 'catCuentasDePagt' => $catCuentasDePagt]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $imagenes=DB::table('imagens')->get();
        $catCuentasDePag=DB::table('categoria_cuenta_de_paginas')->take(5)->get();

        $resientes=DB::table('mi_cuenta_de_pagina')->orderBy('id', 'desc')->take(5)->get();
        return view('layouts.cuentasdepaginas.createCuentaDePagina',['imagenes'=>$imagenes, 'resientes'=>$resientes, 'catCuentasDePag'=>$catCuentasDePag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /** reglas de validacion */
       $reglas=array ('nombrePagina'=>'required', 'url'=>'required|url', 'usuario'=>'required', 'descripsion'=>'string');


       /*primer parametro. datos que envia formulario, segundo parametro las reglas que se deben cumplir*/
       $validator=Validator::make($request->all(),$reglas); 


       /*Si la validacion falla*/
       if ($validator->fails()) {

            return redirect('/nuevaCuentaDePagina')->withErrors($validator)->withInput();

        
        }else{//paso la validacion
            
            //die(print_r($request->all()));
            /*Se filtra los datos resividos*/
            $nombrePagina=htmlentities($request->nombrePagina);
            //die($nombrePagina);
            $url=htmlentities($request->url);
            $usuario=htmlentities($request->usuario);
            $descripsion=htmlentities($request->descripsion);

            try {
            
            $MiCuentaPAgina = new MiCuentaDePagina;

            $MiCuentaPAgina::create([
                'nombre_pagina'=>ucwords($nombrePagina),
                'url'=>$url,
                'usuario'=>$usuario,
                'descripsion'=>$descripsion,

                ]);



            } catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }


            $request->session()->flash('mensaje', 'Su informacion fuer guardada exitosamente');
            return redirect('/nuevaCuentaDePagina');

        } 


       //print_r( $request->all());

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Cuenta De Pagina All

        
        $CDPA=MiCuentaDePagina::find($id);

        if(is_null($CDPA)){

            abort('404');

        }else{

            $CDPA->delete();
            return redirect('/cuentasCreadas');
        
        }

    }


    

}
