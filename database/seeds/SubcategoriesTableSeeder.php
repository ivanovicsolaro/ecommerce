<?php

use Illuminate\Database\Seeder;
use App\Subcategoria;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategoria::create([
        	'nombre' => 'Samsung'
        ]);

        Subcategoria::create([
        	'nombre' => 'Motorola'
        ]);

        Subcategoria::create([
        	'nombre' => 'Iphone'
        ]);

        Subcategoria::create([
        	'nombre' => 'Huawei'
        ]);

        Subcategoria::create([
        	'nombre' => 'Alcatel'
        ]);

        Subcategoria::create([
        	'nombre' => 'Sony'
        ]);

        Subcategoria::create([
        	'nombre' => 'Univ. 4.5'
        ]);

        Subcategoria::create([
        	'nombre' => 'Univ. 5.0'
        ]);

        Subcategoria::create([
        	'nombre' => 'Univ. 5.5'
        ]);

        Subcategoria::create([
        	'nombre' => 'Generícos'
        ]);

           Subcategoria::create([
        	'nombre' => 'Tablet 7"'
        ]);



    }
}
