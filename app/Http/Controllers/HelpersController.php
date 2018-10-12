<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;

use App\Product;

class HelpersController extends Controller
{
    public static function validarStock(){
        $stock = true;
        $producto = [];
        foreach(Cart::model()->items->all() as $item){
            
            $product = Product::find($item->product->id);
            
            if($item->quantity > $product->stock){
                $stock = false;
                array_push($producto, $product->name);
            }
        }
        return ['stock' => $stock, 'producto' => $producto];
    }

    public static function reducirStock(){
        foreach(Cart::model()->items->all() as $item){
            
            $p = Product::find($item->product->id);
            $p->stock -= $item->quantity;
            $p->save();
            
        }
        return 1;
    }

    public static function getUserId(){
        return Auth::id(); 
    }

    public static function restaurarStockByProducto($idProducto, $cantidad){

            $p = Product::find($idProducto);
            $p->stock += $cantidad;
            $p->save();

        return 1;
    }
}
