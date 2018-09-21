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
            'categories'           
        ]);
        
        $this->call(CountriesTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
    
    protected function trucateTables(array $tables){
               
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        foreach ($tables as $table){
            DB::table($table)->truncate();
        }
     
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
