<?php

use Illuminate\Database\Seeder;
use Vanilo\Framework\Models\Customer;

class CustomerTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
        	'firstname' => 'CONSUMIDOR',
        	'lastname' => 'FINAL'
        ]);
    }
}
