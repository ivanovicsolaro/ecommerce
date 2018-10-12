<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
	protected $table = 'movimientos'; 

	protected $fillable = ['tipo_movimiento_id', 'user_responsable_id', 'description', 'comprobante_id', 'ingresos', 'egresos', 'saldo', 'observaciones'];   

	public static function getUltimoMovimiento(){
		return Movimiento::orderBy('id', 'DESC')->limit(1)->get();
	}
}
