<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vanilo\Product\Models\Product;
use Illuminate\Http\JsonResponse;
use DB;

use App\Categoria;
use App\Subcategoria;

class FrontController extends Controller
{
   	public function indexShop(){
   		$productos = DB::table('products_images')
		        	->select('products_images.name as imageName', 'products.*')
		            ->join('products', 'products_images.product_id', '=', 'products.id')
		            ->groupBy('products_images.product_id')
		            ->get();

		$categorias = Categoria::all();
		$subcategorias = Subcategoria::all();

    	return view('front.productos.shop', compact('productos', 'categorias', 'subcategorias'));
    }
}
