<?php

use Illuminate\Database\Seeder;

class PaymentsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments_types')->insert([
        	 'description' => 'Contado Efectivo',
        	 'interes' => 1
        	]);

        DB::table('payments_types')->insert([
        	 'description' => 'Debito',
        	 'interes' => 1
        	]);

        DB::table('payments_types')->insert([
        	 'description' => 'Tarjeta 1 Pago',
        	 'interes' => 1
        	]);

        DB::table('payments_types')->insert([
        	 'description' => 'Tarjeta 3 a 12 Pagos',
        	 'interes' => 1.25
        	]);

        DB::table('payments_types')->insert([
        	 'description' => 'Cuenta Corriente',
        	 'interes' => 1
        	]);
    }
}
