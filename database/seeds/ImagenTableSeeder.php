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
	    "html5", "css", "javascript",
	    "bootstrap", "jquery", "php",
	    "laravel", "mysql"
		);


		for($i=0; $i<8; $i++){

			DB::table('imagens')->insert([
			'nombre' => $array[$i],
			'url' => 'img/'.$array[$i].'.jpg',
		    ]);

		}   
	 }
}
