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
        	'descripcion' => 'Templados',
            'slug' => 'templados'
        ]);

        Categoria::create([
        	'descripcion' => 'Accesorios',
            'slug' => 'accesorios'
        ]);

        Categoria::create([
        	'descripcion' => 'Repuestos',
            'slug' => 'repuestos'
        ]);

        Categoria::create([
        	'descripcion' => 'Baterias',
            'slug' => 'baterias'
        ]);

        Categoria::create([
        	'descripcion' => 'Flip Covers',
            'slug' => 'flip-covers'
        ]);

        Categoria::create([
        	'descripcion' => 'Fundas Rígidas',
            'slug' => 'fundas-rigidas'
        ]);

        Categoria::create([
        	'descripcion' => 'Fundas Líquidas',
            'slug' => 'fundas-liquidas'
        ]);

        Categoria::create([
        	'descripcion' => 'Fundas Flexibles',
            'slug' => 'fundas-flexibles'
        ]);
    }
}
