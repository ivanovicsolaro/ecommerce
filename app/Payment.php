<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentType;
use App\TiposMovimiento;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = ['id', 'order_id', 'tipo_movimiento_id', 'payment_type_id', 'datos_adicionales_pago', 'monto', 'created_at', 'updated_at']; 

    public function paymentTypes(){
    	return $this->hasMany(PaymentType::class, 'id');
    }
}
