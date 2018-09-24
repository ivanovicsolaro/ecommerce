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
        	'descripcion' => 'Samsung',
             'slug' => 'samsung'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Motorola',
             'slug' => 'motorola'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Iphone',
             'slug' => 'iphone'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Huawei',
             'slug' => 'huawei'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Alcatel',
             'slug' => 'alcatel'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Sony',
             'slug' => 'sony'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Universal 4.5',
             'slug' => 'universal-4-5'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Universal 5.0',
             'slug' =>'universal-5-0'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Universal 5.5',
             'slug' => 'universal-5-5'
        ]);

        Subcategoria::create([
        	'descripcion' => 'Generícos',
             'slug' => 'genericos'
        ]);

           Subcategoria::create([
        	'descripcion' => 'Tablet 7',
             'slug' => 'tablet-7'
        ]);



    }
}
