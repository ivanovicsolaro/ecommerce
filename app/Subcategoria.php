<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
	protected $table = 'subcategories';

	protected $fillable = [
        'nombre'
    ];   
}
