<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->trucateTables([
            'countries',
            'provinces',
            'categories',
            'subcategories',
            'products',
            'tipos_movimientos',
            'customers',
            'movimientos',
            'payments_types'      
        ]);
        
        $this->call(CountriesTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(TiposMovimientosSeeder::class);
        $this->call(CustomerTableSeed::class);
        $this->call(MovimientosTableSeed::class);
        $this->call(PaymentsTypesSeeder::class); 
    }
    
    protected function trucateTables(array $tables){
               
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        foreach ($tables as $table){
            DB::table($table)->truncate();
        }
     
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
