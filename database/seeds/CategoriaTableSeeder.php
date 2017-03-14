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


		for($i=0; $i<7; $i++){

			DB::table('categorias')->insert([
			'nombre' => $array[$i],
			'descripsion' => str_random(255)
		    ]);

		}

        

	    
	 }
}
