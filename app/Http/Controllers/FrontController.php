<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Http\JsonResponse;
use DB;
use Session;

use App\Categoria;
use App\Subcategoria;

class FrontController extends Controller
{
   	public function indexShop(Request $request){
   		$productos = Product::busqueda($request->get('busqueda'))
   					->categoria($request->get('categoria'))
   					->subcategoria($request->get('marca'))
   					->paginate(12);

		$categorias = Categoria::all();
		$subcategorias = Subcategoria::all();

		foreach ($productos as $product) {
			$product->image = $product->productImages[0]->name;
		}
    	return view('front.productos.shop', compact('productos', 'categorias', 'subcategorias'));
    }
}
