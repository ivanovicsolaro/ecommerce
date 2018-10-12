<?php

use Illuminate\Database\Seeder;
use App\Movimiento;

class MovimientosTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movimiento::create([
        	'tipo_movimiento_id' => 1,
           	'ingresos' => 10,
           	'saldo' => 10           
        ]);
    }
}
