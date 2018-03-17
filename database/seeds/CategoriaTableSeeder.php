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

		for($i=0; $i<7; $i++){

			DB::table('categorias')->insert([
			'nombre' => $array[$i],
			'imagen' => "img/".$arrayimagenes[$i],
			'descripsion' => str_random(255)
		    ]);

		}

        

	    
	 }
}
