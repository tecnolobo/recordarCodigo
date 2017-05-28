<?php

use Illuminate\Database\Seeder;

class ImagenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
	    "html5", "laravel", "css",
	    "mysql", "javascript", "php",
	    "jquery", "bootstrap"
		);


		for($i=0; $i<sizeof($array); $i++){

			DB::table('imagens')->insert([
			'nombre' => $array[$i],
			'url' => 'img/'.$array[$i].'.jpg',
		    ]);

		}   
	 }
}
