<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon as cc;

use App\ProyectoMasterHtml as PmHtml;

use App\ProyectosMaster as PMaster;

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

        $paginadorlaravel = DB::table('proyecto_laravels')->select('nombre', 'descripsion','id', 'created_at')->orderBy('id', 'desc')->paginate(6,['*'],'laraPage');

        $paginadorhtml = DB::table('proyectos_master')
        ->join('categorias','categorias.id_categoria','=','proyectos_master.id_categoria')
        ->select('proyectos_master.nombre', 'proyectos_master.descripsion','proyectos_master.id', 'categorias.nombre as nombreCategoria', 'proyectos_master.created_at')
        ->orderBy('id', 'desc')->paginate(6);

        $codigosRecordarhtml=$paginadorhtml->toArray();
        $codigosRecordarlaravel=$paginadorlaravel->toArray();
        $codigosRecordarlaravel =array_chunk($codigosRecordarlaravel['data'], 3, false);
        $codigosRecordarhtml =array_chunk($codigosRecordarhtml['data'], 3, false);

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
        $estructucaCategorias=DB::table('categorias')->select('id_categoria','tipos_archivos')->get();
        $machEstructure='';
        $arraymargeMaster = Array();
        
        /*
        convertimos de la tabla categorias la columna tipos_archivos que esta en formato json a un array para que todo el objecto que nos devuelva
        la base de datos sea un array completo, no un array con valores json
        */
        for ($i=0; $i <count($estructucaCategorias) ; $i++) { 
            
            $id_categoria = array('id_categoria'=>$estructucaCategorias[$i]->id_categoria);
            
            $arrayJsonDecode = json_decode($estructucaCategorias[$i]->tipos_archivos,true);
            

            $arraymarge = array_merge($id_categoria,$arrayJsonDecode);

            array_push($arraymargeMaster,$arraymarge);
   
        }
        
        return view('layouts.nuevoRecordatorio',['categorias'=>$categorias , 'imagenes'=>$imagenes, 'estructucaCategorias'=>$arraymargeMaster]);
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

        //$validator=Validator::make($request->all(),$reglas,$mensajes); 

        //$validator->fails()
        //si la validacion falla
        if (false) {

            return redirect('/recordatorio')->withErrors($validator)->withInput();

        
        }else{//paso la validacion
            
            //si el proyecto no es laravel guardamos en la tabla proyectoMaster html
            
            $pMaster = new PMaster;

            $dataTosend = [
                'nombre'      => $request->nombre,
                'descripsion' => $request->descripsion
            ];

            $columnsAdd =[];

            foreach ($request->all() as $item => $value){
                
                
                if(str_contains($item, 'colum')){
                    $columnsAdd += array($item => htmlentities(base64_decode($value)));
                }
                
                
            }

            $resultArray= array_merge($dataTosend,$columnsAdd);
            
            $resultArray += array('id_categoria'=>$request->tipo);

            $pMaster::create($resultArray);

            $request->session()->flash('mensaje', 'Su informacion fuer guardada exitosamente');
            return redirect('/recordatorio');

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

        $imagenes=DB::table('categorias')->get();

        //se hace la consulta relacionada de las tablas proyecto_master_htmls y coteogrias por el campo id_categoria
        //y se seleciona un solo registro por su id
        $codigoMaster= DB::table('proyectos_master')
        ->join('categorias','categorias.id_categoria','=','proyectos_master.id_categoria')
        ->select(
            'proyectos_master.nombre',
            'proyectos_master.descripsion',
            'proyectos_master.colum_1',
            'proyectos_master.colum_2',
            'proyectos_master.colum_3',
            'proyectos_master.colum_4',
            'proyectos_master.colum_5',
            'proyectos_master.colum_6',
            'proyectos_master.colum_7',
            'proyectos_master.colum_8',
            'proyectos_master.colum_9',
            'proyectos_master.colum_10',
            'categorias.nombre as tipo',
            'categorias.id_categoria as id_tipo'
            )->where('id',$id)
            ->get();
        /*
        echo "<pre>";
        print_r($codigoMaster);
        exit();
        echo "<pre>";*/
        if(empty($codigoMaster)){
            abort('404');
        }

        $estructuraCategoria= DB::table('categorias')->select('tipos_archivos')->where('id_categoria', $codigoMaster[0]->id_tipo)->get(); 
        
        $estructuraCategoria = json_decode($estructuraCategoria[0]->tipos_archivos);  

        return view('layouts.showCodigoMaster',['imagenes'=>$imagenes, 'codigo'=>$codigoMaster, 'estructuraCategoria'=>$estructuraCategoria]);    
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCodeMasterHtmlProyect($id)
    {   

        $imagenes=DB::table('categorias')->get();

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
        
            case 28:
                $datos=array('jquery',array('html','css','jquery'));
                break;
            
            default:
                # code...
                break;
        }
                
        return view('layouts.showCodigoMasterHtml',['imagenes'=>$imagenes, 'codigo'=>$codigoMasterHtml, 'datos'=>$datos]);    
        
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

        try {


            foreach ($request->all() as $item => $value){
                                
                if(str_contains($item, 'colum')){

                    if($value !=""){
                        $camposActualizar += array($item => htmlentities($value));
                    }
                    
                }
                
                
            }


            // creamos la nueva instancia del modelo a actualizar
            $PMaster= new PMaster;


            //le pasamos los elementos a actualizar al modelo con base al id
            $PMaster::where('id', $id)->update($camposActualizar);

            $request->session()->flash('success', 'Registro actualizado correctamente ');

            return redirect()->to('/editarCodigo/'.$id);
            
        } catch (Exception $e) {
            
            $request->session()->flash('error', 'Lo sentimos existio un error : '.$e);

            return redirect()->to('/editarCodigo/'.$id);
        }

    }

   

    public function destroyCodigoHtml($id,Request $request)
    {   
        $codigoEliminado=DB::table('proyectos_master')->where('id', '=', $id)->get();
        $codigoEliminado=$codigoEliminado[0]->nombre;
        DB::table('proyectos_master')->where('id', '=', $id)->delete();
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
        $codigoMaster= DB::table('proyectos_master')
        ->join('categorias','categorias.id_categoria','=','proyectos_master.id_categoria')
        ->select(
            'proyectos_master.nombre',
            'proyectos_master.descripsion',
            'proyectos_master.colum_1',
            'proyectos_master.colum_2',
            'proyectos_master.colum_3',
            'proyectos_master.colum_4',
            'proyectos_master.colum_5',
            'proyectos_master.colum_6',
            'proyectos_master.colum_7',
            'proyectos_master.colum_8',
            'proyectos_master.colum_9',
            'proyectos_master.colum_10',
            'categorias.nombre as tipo',
            'categorias.id_categoria as id_tipo'
            )->where('id',$id)
            ->get();

        if(empty($codigoMaster)){
            abort('404');
        }

        
        $estructuraCategoria= DB::table('categorias')->select('tipos_archivos')->where('id_categoria', $codigoMaster[0]->id_tipo)->get(); 
        
        $estructuraCategoria = json_decode($estructuraCategoria[0]->tipos_archivos);  

        return view('layouts.editCodigoMasterHtml',['imagenes'=>$imagenes, 'codigo'=>$codigoMaster, 'id'=>$id, 'estructuraCategoria'=>$estructuraCategoria]);
        
    }


}
