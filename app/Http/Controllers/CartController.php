<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;
use DB;

use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;


use App\Product;

class CartController extends Controller
{
      public function addItem(Request $request){
          
          if ($request->ajax()) {
            
            $data = $request->all();
            
            $producto = Product::find($data['id']);
            $cantidad = $data['cantidad'];

            if(Cart::doesNotExist()){ 
            	$cantTotal = $cantidad;
            }else{
            	$cantTotal = $this->getCantidadByProducto($producto) + $cantidad; 
            }


            if($cantTotal <= $producto->stock){ 
           		
           		Cart::addItem($producto, $cantidad);
                
                $precio = ($producto->price * $cantidad);
                $total = number_format(Cart::total(),2);

                $path = $request->root();
                $i = 0;
	            foreach($producto->productImages as $images){
	            	if($i == 0){
	            		$urlImagen = $path.'/img/products/'.$producto->id.'/'.$images->name;
	            	}
	            	
	            	$i++;
	            }

               return new JsonResponse([
                        'validate' => 1,
                        'total'=> $total,
                        'nombre' => $producto->name,
                        'slug' => $producto->slug,
                        'precio' => $precio,
                        'cantidad' => $cantidad,
                        'urlImagen' => $urlImagen
                    ]);
            }else{            	
                return new JsonResponse([
                    'validate' => 0,
                    'msg' => 'Superó el stock'
                ]);
            }
          }
    }

    private function getCantidadByProducto($producto){
        /*traigo los productos del carrito*/
        $items = Cart::model()->items->all();
        $cantidadCarrito = 0;
        /*obtengo la cantidad de veces que fue agregado el producto promocionado*/
        foreach ($items as $item) {
            if($item->product->id == $producto->id){
                $cantidadCarrito = $item->quantity;
            }
        }
        return $cantidadCarrito;
    }  

    public function viewCart(){
    	
    	if(Cart::exists()){

        	$items = Cart::model()->items->all();
  		 

        	foreach ($items as $item) {
      
        		$imagen = DB::table('products_images')->where('product_id', $item->product->id)->first();
          		$item->product->imagen =  '/img/products/'.$item->product->id.'/'.$imagen->name;
        	}

        }
        
        return view('front.productos.carrito-menu');
    }
}
