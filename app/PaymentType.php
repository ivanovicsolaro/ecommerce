<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payment;

class PaymentType extends Model
{
   	protected $table = 'payments_types';

    protected $fillable = ['id', 'description', 'interes']; 

    public function payments(){
    	return $this->belongsTo(Payment::class);
    }
}
