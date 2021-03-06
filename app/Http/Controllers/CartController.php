<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;
use DB;
use Redirect;

use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;


use App\Product;

class CartController extends Controller
{

      public function index(){
        
        if(Cart::isEmpty()){
            return redirect('/shop')->with('error', 'No posees productos en tu carrito');;
        }

        return view('front.carrito.index-viewCarrito');
      }

      public function addItem(Request $request){
          
          if ($request->ajax()) {
            
            $data = $request->all();

            if(!isset($data['sku'])){
               $producto = Product::find($data['id']);
            }else{
               $result = Product::select('id')->where('sku', $data['sku'])->first();
               $producto = Product::find($result['id']);
            }

            $cantidad = $data['cantidad'];

            if(Cart::doesNotExist()){ 
            	$cantTotal = $cantidad;
            }else{
            	$cantTotal = $this->getCantidadByProducto($producto) + $cantidad; 
            }


            if($cantTotal <= $producto->stock){ 
           		
           		Cart::addItem($producto, $cantidad, [ 'attributes' => [
                    'price_real' => $producto->price_real
              ]
            ]);
                
                $precio = ($producto->price * $cantidad);
                $total = number_format(Cart::total(),2);

                $path = $request->root();
                $i = 0;

                 
                $imagen = DB::table('products_images')->where('path_image', $producto->path_image)->first();
                if(!$imagen){
                    $urlImagen = asset('/img/products/sin-imagen.jpg');
                }else{
                    $urlImagen =  asset('/img/products/'.$producto->path_image.'/thumbnails/'.$imagen->name);
                }

               return new JsonResponse([
                        'validate' => 1,
                        'total'=> $total,
                        'nombre' => $producto->name,
                        'slug' => $producto->slug,
                        'precio' => $precio,
                        'cantidad' => Cart::itemCount(),
                        'urlImagen' => $urlImagen
                    ]);
            }else{            	
                return new JsonResponse([
                    'validate' => 0,
                    'msg' => 'No hay stock suficiente, selecciona una cantidad menor a o igual a '.$producto->stock
                ]);
            }
          }
    }

    public function removeItem(Request $request){
          
          if ($request->ajax()) {
            
           $data = $request->all();

           $producto = Product::find($data['id']);
            
           Cart::addItem($producto, $data['cantidad']);

           if($this->getCantidadByProducto($producto) == 0){
                Cart::removeProduct($producto);
           }

           $total = number_format(Cart::total(),2);
           
           return new JsonResponse([
                'total'=> $total, 
                'cantidad' => Cart::itemCount()
            ]);
        
          };        

    }   

    public function update(Request $request){
          
          if ($request->ajax()) {
            
          $data = $request->all();

          $producto = Product::find($data['id']);
          
          if($data['cantidad'] <= 0){
             Cart::removeProduct($producto);
           }elseif($producto->stock >= $data['cantidad']){
              $cantidadActual = $this->getCantidadByProducto($producto);
              Cart::addItem($producto, (-1)*$cantidadActual);
              Cart::addItem($producto, $data['cantidad']);
           }else{             
                return new JsonResponse([
                    'validate' => 0,
                    'msg' => 'No hay stock suficiente, selecciona una cantidad menor a o igual a '.$producto->stock, 
                    'cantidad' =>  $this->getCantidadByProducto($producto)
                ]);
            }
  
           $total = number_format(Cart::total(),2);
           
           return new JsonResponse([
                'validate' => 1,
                'total'=> $total, 
                'cantidad' => Cart::itemCount()
            ]);
        
          };        

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
      
        	$imagen = DB::table('products_images')->where('path_image', $item->product->path_image)->first();
            if(isset($imagen)){
          		  $item->product->imagen =  '/img/products/'.$item->product->path_image.'/'.$imagen->name;
            }
        	}

        }
        
        return view('front.carrito.carrito-menu');
    }

    public function viewTable(){
     
      if(Cart::exists()){

          $items = Cart::model()->items->all();

          foreach ($items as $item) {
              $imagen = DB::table('products_images')->where('path_image', $item->product->path_image)->first(); 
              if(!$imagen){
                  $item->product->imagen = '/img/products/sin-imagen.jpg';
              }else{
                  $item->product->imagen =  '/img/products/'.$item->product->path_image.'/thumbnails/'.$imagen->name;
              }
              
          }
      }
      return view('front.carrito.table-carrito');
    }

    public function viewTableVenta(){
     
      if(Cart::exists()){

          $items = Cart::model()->items->all();

          foreach ($items as $item) {
              $imagen = DB::table('products_images')->where('path_image', $item->product->path_image)->first();
              if(!$imagen){
                  $item->product->imagen = '/img/products/sin-imagen.jpg';
              }else{
                  $item->product->imagen =  '/img/products/'.$item->product->path_image.'/thumbnails/'.$imagen->name;
              }
              
          }

          $total_real = $this->getTotalReal();
      }

      return view('ventas.table', compact('total_real'));
    }

    private static function getTotalReal(){

        $items = Cart::model()->items->all();
        $total_real = 0;
        foreach ($items as $item) {
            $total_real = $total_real + ($item->quantity * $item->price_real); 
        }

      return $total_real;
    }
}
