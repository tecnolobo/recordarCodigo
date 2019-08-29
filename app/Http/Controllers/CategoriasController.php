<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Carbon\Carbon as cc;

use App\ProyectoMasterHtml as PmHtml;

use App\ProyectoLaravel as Plaravel;

use App\Categoria as Categoria;

use DB;

use Session;

use Validator;

//para subir archivos
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $imagenes=DB::table('categorias')->get();
        $categorias=DB::table('categorias')->get();

        $paginadorcategorias = DB::table('categorias')->select('id_categoria', 'nombre','descripsion', 'imagen')->orderBy('id_categoria', 'desc')->paginate(6);
        $categoriasStructure=$paginadorcategorias->toArray();
        $categoriasStructure =array_chunk($categoriasStructure['data'], 3, false);

        return view('layouts.allcategorias',['categoriasStructure'=>$categoriasStructure , 'imagenes'=>$imagenes, 'paginadorcategorias'=>$paginadorcategorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $imagenes=DB::table('categorias')->get();
        $categorias=DB::table('categorias')->get();
        
        return view('layouts.nuevaCategoria',['categorias'=>$categorias , 'imagenes'=>$imagenes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensajes=array(
            'nombre.required' => 'El campo nombre es Obligatorio',
            'imagen.image' => 'Solo se permiten imagenes',
            'g-recaptcha-response.required' => 'Por favor compruebe que no eres un robot',
            'g-recaptcha-response.recaptcha' => 'Intentelo nuevamente, No existio coincidencias',
        );

        $reglas=array ('nombre'=>'required',  'imagen' => 'image');


        /*primer parametro. datos que envia formulario, segundo parametro las reglas que se deben cumplir*/

        $validator=Validator::make($request->all(),$reglas,$mensajes); 


        //si la validacion falla
        if ($validator->fails()) {

            return redirect('/categorias')->withErrors($validator)->withInput();

        
        }else{//paso la validacion
            
           
            $pCategoria= new Categoria;

            $imagen_name = $request->file('imagen')->getClientOriginalName();
            $extension_img = $request->file('imagen')->getClientOriginalExtension();

            
            /*
            subur archivos con metod laravel
            $file_to_save = '';

            if ($request->hasFile('imagen')){


                $file_to_save = $request->nombre.'_'.rand(1,10000).'_.'.$extension_img;
                Storage::disk('public')->put( $file_to_save, File::get($request->file('imagen')) );
        
            }
            */

            $my_path = $_SERVER['DOCUMENT_ROOT'];

            $target_dir = $my_path."/img/";

            $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

            $image_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $file_to_save = $request->nombre.'_'.rand(1,10000).'_.'.$image_extension;

            $file_to_save = $target_dir.$file_to_save;


            if ($_FILES["imagen"]["size"] > 500000) {

                    $request->session()->flash('mensaje', 'Imagen demaciado grande');
                    return redirect('/categorias');

            }

            if($image_extension != "jpg" && $image_extension != "png" && $image_extension != "jpeg" && $image_extension != "gif" ) {
                $request->session()->flash('mensaje', 'Solo se permiten imagenes');
                return redirect('/categorias');
            }

            //subimos la imagen
            if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $file_to_save)) {
                    
                $request->session()->flash('mensaje', 'Error al subir la imagen');
                return redirect('/categorias');
               
            }

            

            $pCategoria::create([
            'nombre'       => $request->nombre,
            'descripsion'  => $request->descripsion,
            'imagen'       => 'img/'.$file_to_save
            ]);
            

            $request->session()->flash('mensaje', 'Su informacion fuer guardada exitosamente');
            return redirect('/categorias');

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $categoriaEliminada=DB::table('categorias')->where('id_categoria', '=', $id)->get();
        $categoriaEliminada=$categoriaEliminada[0]->nombre;

        DB::table('categorias')->where('id_categoria', '=', $id)->delete();
        //dd('entro');
        $request->session()->flash('mensaje', 'La categoria  "'.$categoriaEliminada.'" Fue eliminada');
        return redirect()->to('categorias');
    }
}
