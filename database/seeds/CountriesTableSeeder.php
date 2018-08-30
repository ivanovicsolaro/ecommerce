<?php

use Illuminate\Database\Seeder;
use App\Countrie;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        Countrie::insert([
        	'id' => 1,
        	'name' => 'Argentina',
        	'phonecode' => '+54',
        	'is_eu_member' => '0'
        ]);
    }
}
