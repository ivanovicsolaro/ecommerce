<?php

use Illuminate\Database\Seeder;
use DB;

class ConfiguracionInicialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')
        	->insert([
        		['title_banner_1' => 1]] 
        	);

        DB::table('settings')
        	->insert([['id' => 'dolar', 'value' => 30]]);

        DB::table('model_roles')
        	->insert([['role_id' => 1, 'model_id' => 1,  'model_type' => 'App\User']]);
    }
}
