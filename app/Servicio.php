<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;

class Servicio extends Model
{
    protected $table = "servicios";
    protected $fillable = ['id', 'customer_id', 'marca', 'modelo', 'nro_serie', 'descripcion_falla', 'diagnostico', 'detalle_mano_obra', 'estado', 'precio_presupuestado', 'precio_final', 'vencimiento', 'created_at', 'updated_at'];

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }
}
