<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
        	'descripcion' => 'Templados'
        ]);

        Categoria::create([
        	'descripcion' => 'Accesorios'
        ]);

        Categoria::create([
        	'descripcion' => 'Repuestos'
        ]);

        Categoria::create([
        	'descripcion' => 'Baterias'
        ]);

        Categoria::create([
        	'descripcion' => 'Flip Covers'
        ]);

        Categoria::create([
        	'descripcion' => 'Fundas Rígidas'
        ]);

        Categoria::create([
        	'descripcion' => 'Fundas Líquidas'
        ]);

        Categoria::create([
        	'descripcion' => 'Fundas Flexibles'
        ]);
    }
}
