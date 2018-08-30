<?php

use Illuminate\Database\Seeder;
use App\Province;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::insert([
        	'id' => 1,
        	'country_id' => 1,
        	'type' => 'province',
        	'code' => '1',
        	'name' => 'Entre Rios'
        ]);
    }
}
