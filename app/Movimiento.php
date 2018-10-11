<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
	protected $table = 'movimientos'; 

	protected $fillable = ['tipo_movimiento_id', 'description', 'comprobante_id', 'ingresos', 'egresos', 'saldo', 'observaciones'];   
}
