<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Http\JsonResponse;
use DB;
use Session;

use App\Categoria;
use App\Subcategoria;
use App\Banner;

class FrontController extends Controller
{
    public function index(){
      
      $banner = Banner::find(1);

      return view('welcome', compact('banner'));
    }

   	public function indexShop(Request $request){
   	$productos = Product::busqueda($request->get('busqueda'))
   					->categoria($request->get('categoria'))
   					->subcategoria($request->get('marca'))
            ->whereNull('deleted_at')
            ->orderBy('destacado', 'desc')
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
  
     return view('front.productos.shop', compact('productos', 'categorias', 'subcategorias', 'ranking'));
    }

    public function detalleProducto($slug){

        $producto = Product::findBySlug($slug);

        $categoria = Categoria::where('id', $producto->categorie_id)->get();

        $subcategoria = Subcategoria::where('id', $producto->subcategorie_id)->get();

        $relacionados = $this->getProductosRelacionados($producto->categorie_id, $producto->subcategorie_id);

        $imagenes = DB::table('products_images')->where('product_id', $producto->id)->get();
       
        $imagenes = json_encode($imagenes);


     
        $producto = array_add($producto, 'imagenes', $imagenes);
       
        return view('front.productos.view', [
            'producto' => $producto,
            'relacionados' => $relacionados,
            'categoria' => $categoria,
            'subcategoria' => $subcategoria
        ]);
    }

    private function getProductosRelacionados($categoria_id, $subcategoria_id ){
        return DB::table('products_images')
                        ->select('products_images.name as imageName', 'products.*')
                        ->join('products', 'products_images.product_id', '=', 'products.id')
                        ->groupBy('products_images.product_id')
                        ->where('categorie_id', $categoria_id)
                        ->where('subcategorie_id', $subcategoria_id)
                        ->limit(4)->get();
    }
}
