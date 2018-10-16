<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class CuentaCorriente extends Model
{
    protected $table = 'cuentas_corrientes';

    protected $fillable = ['payment_type_id', 'customer_id', 'description', 'comprobante_id', 'ingresos', 'egresos', 'observaciones'];   

    public function Client(){
    	return $this->hasOne(Client::class);
    }

    public static function getUltimoRegistro($idCustomer){

    	$ultimoRegistro = CuentaCorriente::where('customer_id', $idCustomer)->orderBy('id', 'DESC')->limit(1)->get();
    	
    	if($ultimoRegistro->isEmpty()){
    		CuentaCorriente::create([
				    'tipo_movimiento_id' => 3,
				    'customer_id' => $idCustomer,
				    'description' => 'Inicio C/C',
				    'saldo' => 0
			]);

    		$ultimoRegistro = CuentaCorriente::where('customer_id', $idCustomer)->orderBy('id', 'DESC')->limit(1)->get();

    		return $ultimoRegistro;

    	}else{
    		
    		return $ultimoRegistro;
    	}    	
    }

}
