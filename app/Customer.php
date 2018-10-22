<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Servicio;

class Customer extends Model
{
    public function servicio(){
    	$this->hasMany(Servicio::class);
    }
}
