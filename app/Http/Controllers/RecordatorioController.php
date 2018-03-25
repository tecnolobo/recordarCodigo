<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon as cc;

use App\ProyectoMasterHtml as PmHtml;

use App\ProyectoLaravel as Plaravel;

use DB;

use Session;

use Validator;

class RecordatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   


        $imagenes=DB::table('categorias')->get();
        /*$codigos=PmHtml::find(3);
        dd($codigos->created_at->toFormattedDateString());*/
        $paginadorlaravel = DB::table('proyecto_laravels')->select('nombre', 'descripsion','id', 'created_at')->orderBy('id', 'desc')->paginate(6,['*'],'laraPage');
        //dd($paginadorlaravel[0]->created_at->toFormattedDateString());
        $paginadorhtml = DB::table('proyecto_master_htmls')->select('nombre', 'descripsion','id', 'created_at')->orderBy('id', 'desc')->paginate(6);
        $codigosRecordarhtml=$paginadorhtml->toArray();
        $codigosRecordarlaravel=$paginadorlaravel->toArray();
        $codigosRecordarlaravel =array_chunk($codigosRecordarlaravel['data'], 3, false);
        $codigosRecordarhtml =array_chunk($codigosRecordarhtml['data'], 3, false);
        /*echo "<pre>";
        print_r($codigosRecordar);
        echo "</pre>";
        exit;*/
        return view('layouts.index',['imagenes'=>$imagenes , 'codigosRecordarhtml'=>$codigosRecordarhtml , 'paginadorhtml'=>$paginadorhtml ,'codigosRecordarlaravel'=>$codigosRecordarlaravel, 'paginadorlaravel'=>$paginadorlaravel ]);
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
        
        return view('layouts.nuevoRecordatorio',['categorias'=>$categorias , 'imagenes'=>$imagenes]);
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
            'tipo.required' => 'El campo tipo es Obligatorio',
            'tipo.numeric' => 'El campo solo acepta numeros',
            'g-recaptcha-response.required' => 'Por favor compruebe que no eres un robot',
            'g-recaptcha-response.recaptcha' => 'Intentelo nuevamente, No existio coincidencias',
        );

        $reglas=array ('nombre'=>'required', 'tipo'=>'required|numeric', 'g-recaptcha-response' => 'required|recaptcha');


        /*primer parametro. datos que envia formulario, segundo parametro las reglas que se deben cumplir*/

        $validator=Validator::make($request->all(),$reglas,$mensajes); 


        //si la validacion falla
        if ($validator->fails()) {

            return redirect('/recordatorio')->withErrors($validator)->withInput();

        
        }else{//paso la validacion
            
            //si el proyecto no es laravel guardamos en la tabla proyectoMaster html

            if($request->tipo != 2){
                echo "entro a proyecto html";
                echo $request->tipo;
                $pmHtml = new PmHtml;

                $html=htmlentities($request->html);
                $css=htmlentities($request->css);
                $php=htmlentities($request->php);;
                $javascript=htmlentities($request->javascript);;
                $jquery=htmlentities($request->jquery);

                $pmHtml::create([
                'nombre'     => $request->nombre,
                'descripsion'=>$request->descripsion,
                'html'       => $html,
                'css'        => $css,
                'php'        => $php,
                'javascript' =>$javascript,
                'jquery'     => $jquery,
                'id_categoria'=>$request->tipo,
                ]);

            }else{
                echo $request->tipo;
                echo "entro a app laravel";
               $pLaravel= new Plaravel;

               $modelo=htmlentities($request->modelo);
               $vista=htmlentities($request->vista);
               $controlador=htmlentities($request->controlador); 

               $pLaravel::create([
                'nombre'       => $request->nombre,
                'descripsion'  => $request->descripsion,
                'modelo'       => $modelo,
                'vista'        => $vista,
                'controlador'  => $controlador,
                'id_categoria' =>$request->tipo,
                ]);
            }

            $request->session()->flash('mensaje', 'Su informacion fuer guardada exitosamente');
            return redirect('/recordatorio');

        }

        /*$id_categoria=$request->tipo;
        $id_cat=explode("_",$id_categoria);
        $id_cat=$id_cat[1];
        if( empty($request->input('nombre'))){

            echo "no hay nada";
            $request->session()->flash('estado', 'Porfavor no deje el nombre Vacio');
            return redirect('/recordatorio');

        }else{

            echo "si hay <br>";
            echo "<br>";
            print_r($request->all());
        }*/


       

        
       // $pmHtml::create(['nombre' => $request->nombre , 'id_categoria'=>$id_cat]);
        //print_r($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imagenes=DB::table('categorias')->get();
        //se hace la consulta relacionada de las tablas proyecto_master_htmls y coteogrias por el campo id_categoria
        //y se seleciona un solo registro por su id
        $codigoMasterHtml= DB::table('proyecto_master_htmls')
        ->join('categorias','categorias.id_categoria','=','proyecto_master_htmls.id_categoria')
        ->select(
            'proyecto_master_htmls.nombre',
            'proyecto_master_htmls.descripsion',
            'proyecto_master_htmls.html',
            'proyecto_master_htmls.css',
            'proyecto_master_htmls.php',
            'proyecto_master_htmls.javascript',
            'proyecto_master_htmls.jquery',
            'categorias.nombre as tipo',
            'categorias.id_categoria as id_tipo'
            )->where('id',$id)
            ->get();

        if(empty($codigoMasterHtml)){
            abort('404');
        }

        switch ($codigoMasterHtml[0]->id_tipo) {
            
            case 1:
                $datos=array('html',array('html'));
                break;

            case 2:
                $datos=array('laravel',array('modelo','vista','controlador'));
                break;

            case 3:
                $datos=array('htmlycss',array('html','css'));
                break;

            case 4:
                $datos=array('apphtml',array('html','css','javascript','jquery','php'));
                break;

            case 5:
                $datos=array('javascript',array('html','css','javascript'));
                break;

            case 6:
                $datos=array('php',array('html','php'));
                break;

            case 7:
                $datos=array('jquery',array('html','css','jquery'));
                break;
            
            default:
                # code...
                break;
        }


        /*echo $codigoMasterHtml[0]->tipo;
        echo $codigoMasterHtml[0]->id_tipo;
        dd($datos);
        exit;*/
        //dd($codigoMasterHtml);
        return view('layouts.showCodigoMasterHtml',['imagenes'=>$imagenes, 'codigo'=>$codigoMasterHtml, 'datos'=>$datos]);
    }



    public function showCodigoLaravel($id)
    {
        $imagenes=DB::table('categorias')->get();

        $codigoLaravel=DB::table('proyecto_laravels')->where('id',$id)->get();

        $datos= array('modelo','vista','controlador');   

        //dd($codigoLaravel); 
   
        return view('layouts.showCodigoLaravel',['imagenes'=>$imagenes, 'codigo'=>$codigoLaravel, 'datos'=>$datos]);
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
    public function updateCodigoMasterHtml(Request $request)
    {   

        $camposActualizar= [];

        $id=$request->id;
        $html=htmlentities($request->html);
        $css=htmlentities($request->css);
        $php=htmlentities($request->php);;
        $javascript=htmlentities($request->javascript);;
        $jquery=htmlentities($request->jquery);

        try {

            // armamos el arreglo que pasaremos para actualiar el modelo(registro)
            if($html != ""){ $camposActualizar['html'] = $html; }
            if($css != ""){ $camposActualizar['css'] =  $css; }
            if($php != ""){ $camposActualizar['php'] = $php; }
            if($javascript != ""){ $camposActualizar['javascript'] = $javascript; }
            if($jquery != ""){ $camposActualizar['jquery'] = $jquery; }

            // creamos la nueva instancia del modelo a actualizar
            $PmHtml= new PmHtml;

            //le pasamos los elementos a actualizar al modelo con base al id
            $PmHtml::where('id', $id)->update($camposActualizar);


            $request->session()->flash('success', 'Registro actualizado correctamente ');

            return redirect()->to('/editarCodigo/'.$id);
            
        } catch (Exception $e) {
            
            $request->session()->flash('error', 'Lo sentimos existio un error : '.$e);

            return redirect()->to('/editarCodigo/'.$id);
        }

    }

   

    public function destroyCodigoHtml($id,Request $request)
    {   
        $codigoEliminado=DB::table('proyecto_laravels')->where('id', '=', $id)->get();
        $codigoEliminado=$codigoEliminado[0]->nombre;
        DB::table('proyecto_master_htmls')->where('id', '=', $id)->delete();
        //return "eliminado";
        $request->session()->flash('mensaje', 'El codigo  Para "'.$codigoEliminado.'" Fue eliminado');
        return redirect()->to('/');
    }



    public function destroyCodigoLaravel($id, Request $request)
    {
        $codigoEliminado=DB::table('proyecto_laravels')->where('id', '=', $id)->get();
        $codigoEliminado=$codigoEliminado[0]->nombre;
        DB::table('proyecto_laravels')->where('id', '=', $id)->delete();
        //dd('entro');
        $request->session()->flash('mensaje', 'El codigo  Para "'.$codigoEliminado.'" Fue eliminado');
        return redirect()->to('/');
    }



    public function categoria($id,Request $request)
    {   

        $imagenes=DB::table('categorias')->get();

        $paginadorhtml = DB::table('proyecto_master_htmls')
        ->select('nombre', 'descripsion','id', 'id_categoria', 'created_at')
        ->orderBy('id', 'desc')
        ->where('id_categoria',$id)
        ->paginate(6);
        
        $codigosRecordarhtml=$paginadorhtml->toArray();
        
        $codigosRecordarhtml =array_chunk($codigosRecordarhtml['data'], 3, false);
        
        /*tomamos el nombre de la categoria para enviarla*/
        foreach ($imagenes as $categorias) {
            if($categorias->id_categoria == $id ){

                $nombre_categoria=$categorias->nombre;
            
            }
        }

        /*verificamos sino existen elementos*/
        if(!empty($codigosRecordarhtml)){
            
            return view('layouts.categorias',['imagenes'=>$imagenes , 'codigosRecordarhtml'=>$codigosRecordarhtml , 'paginadorhtml'=>$paginadorhtml, 'nombre'=>$nombre_categoria  ]);
           
        }else{

            //Si no existen resultados redirigimos   
            $request->session()->flash('mensaje', 'Lo sentimos pero no se an encontrado elementos para esta categoria');
            return redirect('/');
        
        }

    }

    public function buscar(Request $request)
    {   
        $buscar = $request->buscar;

        $imagenes=DB::table('categorias')->get();

        $paginadorhtml = DB::table('proyecto_master_htmls')
        ->select('nombre', 'descripsion','id', 'id_categoria', 'created_at')
        ->where('nombre', 'like', '%'.$buscar.'%')
        ->orderBy('id', 'desc')
        ->paginate(6);

        
        //Se le agrega el parametro de busqueda al paginador
        $paginadorhtml->appends(['buscar' => $buscar]);

        
        $codigosRecordarhtml=$paginadorhtml->toArray();
        
        $codigosRecordarhtml =array_chunk($codigosRecordarhtml['data'], 3, false);

        
        
        /*verificamos sino existen elementos*/
        if(!empty($codigosRecordarhtml)){
            $request->session()->flash('busqueda', '<h3><span class="label label-success">'.$buscar.'</span></h3>');
            return view('layouts.categorias',['imagenes'=>$imagenes , 'codigosRecordarhtml'=>$codigosRecordarhtml , 'paginadorhtml'=>$paginadorhtml, 'nombre'=>'Resultados']);
           
        }else{

            //Si no existen resultados redirigimos  
            $request->session()->flash('mensaje', 'Lo sentimos pero no se an encontrado Coincidencias');
            $request->session()->flash('busqueda', '<h3><span class="label label-danger">'.$buscar.'</span></h3>');
            return redirect('/');
        
        }

    }


    public function editHtmlMaster($id){


        $imagenes=DB::table('categorias')->get();
        //se hace la consulta relacionada de las tablas proyecto_master_htmls y coteogrias por el campo id_categoria
        //y se seleciona un solo registro por su id
        $codigoMasterHtml= DB::table('proyecto_master_htmls')
        ->join('categorias','categorias.id_categoria','=','proyecto_master_htmls.id_categoria')
        ->select(
            'proyecto_master_htmls.nombre',
            'proyecto_master_htmls.descripsion',
            'proyecto_master_htmls.html',
            'proyecto_master_htmls.css',
            'proyecto_master_htmls.php',
            'proyecto_master_htmls.javascript',
            'proyecto_master_htmls.jquery',
            'categorias.nombre as tipo',
            'categorias.id_categoria as id_tipo'
            )->where('id',$id)
            ->get();

        if(empty($codigoMasterHtml)){
            abort('404');
        }


        switch ($codigoMasterHtml[0]->id_tipo) {
            
            case 1:
                $datos=array('html',array('html'));
                break;

            case 2:
                $datos=array('laravel',array('modelo','vista','controlador'));
                break;

            case 3:
                $datos=array('htmlycss',array('html','css'));
                break;

            case 4:
                $datos=array('apphtml',array('html','css','javascript','jquery','php'));
                break;

            case 5:
                $datos=array('javascript',array('html','css','javascript'));
                break;

            case 6:
                $datos=array('php',array('html','php'));
                break;

            case 7:
                $datos=array('jquery',array('html','css','jquery'));
                break;
            
            default:
                # code...
                break;
        }


        /*echo $codigoMasterHtml[0]->tipo;
        echo $codigoMasterHtml[0]->id_tipo;
        dd($datos);
        exit;*/
        //dd($codigoMasterHtml);
        return view('layouts.editCodigoMasterHtml',['imagenes'=>$imagenes, 'codigo'=>$codigoMasterHtml, 'id'=>$id, 'datos'=>$datos]);
        
    }


}
