<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CuentaCorriente;

class Client extends Model
{
    protected $table = 'clients';

    public function cuentaCorriente(){
    	return $this->belongsTo(CuentaCorriente::class);
    }
}
