<?php

use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$array = array(
	    "html", "laravel", "htmlycss",
	    "apphtml", "javascript", "php",
	    "jquery"
		);

    	$arrayimagenes = array(
	    "html5.jpg", "laravel.jpg", "htmlycss.jpg",
	    "apphtml.jpg", "javascript.jpg", "php.jpg",
	    "jquery.jpg"
		);

		for($i=0; $i<count($array); $i++){

			switch ($array[$i]) {
				case 'html':
					$codigos =array('nombre'=>$array[$i],
									'tipos_archivos'=>array(
															array('nombre'=>'html',
																  'modo'=>'htmlmixed',
																  'nombre_column'=>'colum_1',
																  'extension_archivo'=>'text/html'
																  )
														   )
								);
					break;

				case 'laravel':
					$codigos =array('nombre'=>$array[$i],
									'tipos_archivos'=>array(
															array(
																  'nombre'=>'modelo',
																  'modo'=>'php',
																  'nombre_column'=>'colum_1',
																  'extension_archivo'=>'php'
																),
															array(
																  'nombre'=>'vista',
																  'modo'=>'htmlmixed',
																  'nombre_column'=>'colum_2',
																  'extension_archivo'=>'text/html'
																),
															array(
																  'nombre'=>'controlador',
																  'modo'=>'php',
																  'nombre_column'=>'colum_3',
																  'extension_archivo'=>'php'
																)
														   )
								);
					break;
				
				case 'htmlycss':
					$codigos =array('nombre'=>$array[$i],
									'tipos_archivos'=>array(
															array(
																  'nombre'=>'html',
																  'modo'=>'htmlmixed',
																  'nombre_column'=>'colum_1',
																  'extension_archivo'=>'text/html'
																),
															array(
																  'nombre'=>'css',
																  'modo'=>'css',
																  'nombre_column'=>'colum_2',
																  'extension_archivo'=>'css'
																)
															)
								);
				break;


				case 'apphtml':
					$codigos =array('nombre'=>$array[$i],
									'tipos_archivos'=>array(
															array(
																  'nombre'=>'html',
																  'modo'=>'htmlmixed',
																  'nombre_column'=>'colum_1',
																  'extension_archivo'=>'text/html'
																),
															array(
																  'nombre'=>'css',
																  'modo'=>'css',
																  'nombre_column'=>'colum_2',
																  'extension_archivo'=>'css'
																),
															array(
																  'nombre'=>'javascript',
																  'modo'=>'javascript',
																  'nombre_column'=>'colum_3',
																  'extension_archivo'=>'javascript'
																),
															array(
																  'nombre'=>'php',
																  'modo'=>'php',
																  'nombre_column'=>'colum_4',
																  'extension_archivo'=>'php'
																  )
															)
								);
				break;			
				
				
				case 'javascript':
					$codigos =array('nombre'=>$array[$i],
									'tipos_archivos'=>array(
															array(
																  'nombre'=>'javascript',
																  'modo'=>'javascript',
																  'nombre_column'=>'colum_1',
																  'extension_archivo'=>'javascript')
															)
								);
				break;		
				
				case 'php':
					$codigos =array('nombre'=>$array[$i],
									'tipos_archivos'=>array(
															array(
																   'nombre'=>'php',
																   'modo'=>'php',
																   'nombre_column'=>'colum_1',
																   'extension_archivo'=>'php'
																)
															)
								);
				break;	
				
				
				case 'jquery':
					$codigos =array('nombre'=>$array[$i],
									'tipos_archivos'=>array(
															array(
																   'nombre'=>'jquery',
																   'modo'=>'javascript',
																   'nombre_column'=>'colum_1',
																   'extension_archivo'=>'jquery'
																)
															)
								);
				break;					
				

			}

			DB::table('categorias')->insert([
			'nombre' => $array[$i],
			'imagen' => "img/".$arrayimagenes[$i],
			'tipos_archivos'=>json_encode($codigos),
			'descripsion' => str_random(255)
		    ]);

		}

        

	    
	 }
}
