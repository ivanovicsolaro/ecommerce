<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['type','name','country_id','province_id','postalcode','city','address','number','piso','depto','localidad'];
}
