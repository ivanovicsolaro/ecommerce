<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Auth;
use Crypt;
use DB;

use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;

use App\Product;
use App\PaymentType;

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

    public function findPayment(request $request){
        
        $formaPago = PaymentType::find($request->get('idFormaPago'));
        $tipoMovimiento = DB::table('tipos_movimientos')->where('id', $request->get('idTipoMovimiento'))->get();
        $montoInteres = number_format($request->get('monto') * $formaPago['interes'],2);

        return new JsonResponse([
            'idFP' => $formaPago['id'],
            'desFP' => $formaPago['description'],
            'idTM' => $tipoMovimiento[0]->id,
            'desTM' => $tipoMovimiento[0]->description,
            'montoInteres' => $montoInteres,
            'monto' => $request->get('monto')
        ]);
    }
}
