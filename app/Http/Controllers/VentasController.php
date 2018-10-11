<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\HelpersController;

use App\Movimiento;
use App\TiposMovimiento;
use App\Product;

use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;
use Vanilo\Order\Models\Order;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $ordenes = Order::orderBy('id', 'DESC')
                    ->get();
           return view('ventas.index',compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposMovimientos = TiposMovimiento::pluck('description', 'id')->all();
        return view('ventas.create', compact('tiposMovimientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){

            $data = $request->all();

            if(Cart::isEmpty()){
                return new JsonResponse([
                    'type' => 'error',
                    'msj' => 'No existen productos en su carrito'
                ]);
            }

        $stock = HelpersController::validarStock();

        if($stock['stock']){

            $s = HelpersController::reducirStock();
            $monto = str_replace(',','', $data['total']);
           
              $mtototal = $monto;
         

            /* genero el pedido en estado pendiente */
            $nro_pedido = HelpersController::getUserId().strftime("%d%m%g%H%M");

            $order = Order::create([
                'number' => $nro_pedido,
                'status' => 'completed',
                'user_venta_id' => HelpersController::getUserId(),
                'payment' => $data['formaPago'],
                'total_amount' => $mtototal,
                'client_id'     => $data['cliente']
            ]);

            /*agrego los productos al pedido*/
            foreach(Cart::model()->items->all() as $item){

                $product = Product::find($item->product->id);

                $order->items()->create([
                    'product_type' => 'product',
                    'product_id'   => $product->id,
                    'price'        => $product->price,
                    'name'         => $product->name,
                    'quantity'     => $item->quantity
                ]);
            }

            $movimientos = Movimiento::all();
            $ultimoRegistro = $movimientos->last();

            $ultimoRegistro->saldo + $mtototal;

            if($data['formaPago'] == 2){
                $mtototal = 0;
                $saldo = $ultimoRegistro->saldo;
            }

            Movimiento::create([
                'tipo_movimiento_id' => $data['tipoMovimiento'],
                'description' => 'Movimiento Automático',
                'comprobante_id' => $nro_pedido,
                'ingresos' => $mtototal,
                'saldo' => $saldo
            ]);
            
           
            
        }else{
            return new JsonResponse([
                    'type' => 'error',
                    'msj' => 'No existe suficiente stock del producto '.$stock['producto'][0]
                ]);
        }



        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
