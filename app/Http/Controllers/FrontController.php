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

    $ranking = DB::table('cart_items')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->select('products.*')
            ->groupBy('product_id')
            ->orderByRaw('SUM(quantity) desc')
            ->limit(6)
            ->get();

		$categorias = Categoria::all();
		$subcategorias = Subcategoria::all();

		foreach ($productos as $product) {
       $imagen = DB::table('products_images')->where('product_id', $product->id)->first();
       if(isset($imagen)){
          $product->image = $imagen->name;
        }
		}

    foreach ($ranking as $r) {
       $imagen = DB::table('products_images')->where('product_id', $r->id)->first();
       if(isset($imagen)){
          $r->image = $imagen->name;
        }
    }
  
     return view('front.productos.shop1', compact('productos', 'categorias', 'subcategorias', 'ranking'));
    }
}
