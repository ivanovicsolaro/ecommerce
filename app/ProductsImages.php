<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductsImages extends Model
{	
	protected $table = "products_images";

    protected $fillable = ['id', 'path_image', 'name', 'destacada'];

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
