<?php

use Illuminate\Database\Seeder;
use App\TiposMovimiento;

class TiposMovimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         TiposMovimiento::insert([
        	'description' => 'Boleta'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Factura'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Nota de Crédito'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Nota de Débito'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Presupuesto'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Remito'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Apertura Caja Diaria / Efectivo en Caja'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Cierre Caja Diaria / Retiro de Efectivo'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Ingresos Varios Efectivo a Caja'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Gasto de Cafeteria'
        ]);

        TiposMovimiento::insert([
        	'description' => 'Pago Alquiler'
        ]);
    }
}
