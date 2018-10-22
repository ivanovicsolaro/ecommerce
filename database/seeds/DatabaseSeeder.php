<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'payments_types',
            'movimientos'
                  
        ]);
        
        $this->call(CountriesTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(TiposMovimientosSeeder::class);
        $this->call(CustomerTableSeed::class);
        $this->call(PaymentsTypesSeeder::class); 
        $this->call(MovimientosTableSeed::class);

        DB::table('banners')
            ->insert([
                ['title_banner_1' => 1]] 
            );

        DB::table('settings')
            ->insert([['id' => 'dolar', 'value' => 30]]);

        DB::table('model_roles')
            ->insert([['role_id' => 1, 'model_id' => 1,  'model_type' => 'App\User']]);

    }
    
    protected function trucateTables(array $tables){
               
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        foreach ($tables as $table){
            DB::table($table)->truncate();
        }
     
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
