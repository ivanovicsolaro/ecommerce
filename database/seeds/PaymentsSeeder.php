<?php

use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
        	 'description' => 'Contado Efectivo',
        	 'interes' => 0
        	]);

        DB::table('payments')->insert([
        	 'description' => 'Debito',
        	 'interes' => 0
        	]);

        DB::table('payments')->insert([
        	 'description' => 'Tarjeta 1 Pago',
        	 'interes' => 0
        	]);

        DB::table('payments')->insert([
        	 'description' => 'Tarjeta 3 a 12 Pagos',
        	 'interes' => 0.25
        	]);

        DB::table('payments')->insert([
        	 'description' => 'Cuenta Corriente',
        	 'interes' => 0
        	]);
    }
}
