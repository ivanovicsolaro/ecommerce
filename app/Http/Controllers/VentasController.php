<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\HelpersController;

use App\Movimiento;
use App\TiposMovimiento;
use App\Product;
use App\CuentaCorriente;

use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;
use Vanilo\Order\Models\Order;
use Vanilo\Framework\Models\Customer;
use Vanilo\Order\Models\OrderItem;

use Redirect;
use Crypt;
use DB;
use Carbon\Carbon;

class VentasController extends Controller
{
    public function __construct(){
         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

              
        $inicio = new Carbon('last sunday');                    
        
        $fin = new Carbon('next sunday');

        $ordenes = Order::orderBy('id', 'DESC')
                    ->whereBetween('created_at', [$inicio, $fin])->get();

           $ultimoRegistroCaja = Movimiento::getUltimoMovimiento();
           $tCaja = $ultimoRegistroCaja[0]->saldo;
           $cVentas = Order::where('status', 'Completed')
                    ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->count();

           $cVentasTarjeta = Order::where('payment', 2)
                    ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->sum('total_amount');

           $enviosPendientes = Order::where('status', 'pending')
                                ->whereNotNull('shipping')->count();

           return view('ventas.index',compact('ordenes', 'cVentas', 'cVentasTarjeta', 'tCaja', 'enviosPendientes'));
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
                'status' => 'pending',
                'customer_id' => $data['cliente'],
                'user_venta_id' => HelpersController::getUserId(),
                'total_amount' => $mtototal
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

/*
            $ultimoRegistro = Movimiento::getUltimoMovimiento();
            $saldo = $ultimoRegistro[0]->saldo + $mtototal;

            if($data['formaPago'] != 1){
                $mtototal = 0;
                $saldo = $ultimoRegistro->saldo;
            }

            Movimiento::create([
                'tipo_movimiento_id' => $data['tipoMovimiento'],
                'user_responsable_id' => HelpersController::getUserId(),
                'description' => 'Movimiento Automático',
                'comprobante_id' => $nro_pedido,
                'ingresos' => $mtototal,
                'saldo' => $saldo
            ]);

            if($data['cliente'] != 1){
                $ultimoRegistro = CuentaCorriente::getUltimoRegistro($data['cliente']);
                CuentaCorriente::create([
                    'tipo_movimiento_id' => $data['tipoMovimiento'],
                    'customer_id' => $data['cliente'],
                    'description' => 'Venta Caja',
                    'comprobante_id' => $nro_pedido,
                    'ingresos' => $mtototal,
                    'saldo' => $ultimoRegistro[0]->saldo + $mtototal
                ]);
            }
            */
            
            Cart::clear();

            $urlRedirect = asset('ventas/'.Crypt::encrypt($order->id));
            
           return new JsonResponse([
                    'type' => 'success',
                    'msj' => 'Venta generada exitosamente', 
                    'redirect' => $urlRedirect
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
        $order = Order::find(Crypt::decrypt($id));
        $customer = Customer::find($order->customer_id);
        $tiposMovimientos = TiposMovimiento::pluck('description', 'id')->all();
        return view('ventas.view', compact('order', 'tiposMovimientos', 'customer'));
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

        $order = Order::find(Crypt::decrypt($id));

        $orderItems = DB::table('order_items')
                    ->where('order_id',  $order->id)->get();

        foreach ($orderItems as $item) {
            $s = HelpersController::restaurarStockByProducto($item->product_id, $item->quantity);
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect('ventas');
    }
}
