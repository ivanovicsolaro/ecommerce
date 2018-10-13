<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
   	protected $table = 'payments_types';

    protected $fillable = ['id', 'description', 'interes']; 
}
