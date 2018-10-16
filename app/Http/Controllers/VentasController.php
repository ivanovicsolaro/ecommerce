<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\HelpersController;

use App\Movimiento;
use App\TiposMovimiento;
use App\Product;
use App\CuentaCorriente;
use App\PaymentType;
use App\Payment;

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
           $cVentas = Order::where('status', 'completed')
                    ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->count();

           $cVentasTarjeta = Payment::where('payment_type_id', 2)
                            ->orWhere('payment_type_id', 2)
                            ->orWhere('payment_type_id', 4)
                            ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->sum('monto');

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
                    'price'        => $product->price_real,
                    'name'         => $product->name,
                    'quantity'     => $item->quantity
                ]);
            }

            if($data['cliente'] != 1){
                $ultimoRegistro = CuentaCorriente::getUltimoRegistro($data['cliente']);
                CuentaCorriente::create([
                    'payment_type_id' => NULL,
                    'customer_id' => $data['cliente'],
                    'description' => 'Venta Caja',
                    'comprobante_id' => $nro_pedido,
                    'egresos' =>  $mtototal
                ]);
            }
            
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
        $formasPago = PaymentType::pluck('description', 'id')->all();
        $pagos = DB::table('payments')
            ->select('*', 'payments_types.description as dFP')
                ->join('payments_types', 'payments.payment_type_id', '=', 'payments_types.id')
                ->join('tipos_movimientos', 'payments.tipo_movimiento_id', '=', 'tipos_movimientos.id')
                ->where('order_id', Crypt::decrypt($id))
                ->get();

        return view('ventas.view', compact('order', 'tiposMovimientos', 'customer', 'formasPago', 'pagos'));
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

        if($order->customer_id != 1){
            CuentaCorriente::create([
                'payment_type_id' => NULL,
                'customer_id' => $order->customer_id,
                'description' => 'Cancelación de Pedido',
                'comprobante_id' => $order->number,
                'ingresos' =>  $order->total_amount
            ]);
        }

        return redirect('ventas');
    }

    public function agregarPagos(Request $request, $id){
        if($request->ajax()){
            $data = $request->all();

            if(!isset($data['array'])){
                return new JsonResponse(['type' => 'error', 'msj' => 'Ingrese una forma de pago']);
            }

            $total = 0;
            foreach ($data['array'] as $datos){
                $total = $total + $datos['monto'];
            }

            
            $order = Order::find(Crypt::decrypt($id));


            if($order->total_amount != $total){
                return new JsonResponse(['type' => 'error', 'msj' => 'El monto de la orden ($'.number_format($order->total_amount,2).') no es igual al monto ingresado ($'.number_format($total,2).')']);
            }

            foreach ($data['array'] as $datos){
                Payment::create([
                  'order_id' => $order->id,
                  'tipo_movimiento_id' => $datos['idTM'],
                  'payment_type_id' => $datos['idFP'],
                  'monto' => $datos['montoInteres']  
                ]);
            }

            $order->status = 'completed';
            $order->save();

            foreach ($data['array'] as $datos){

                if($data['id_cliente'] != 1 && $datos['idFP'] != 5){
                    $ultimoRegistro = CuentaCorriente::getUltimoRegistro($data['id_cliente']);
                    CuentaCorriente::create([
                        'payment_type_id' => $datos['idFP'],
                        'customer_id' => $data['id_cliente'],
                        'description' => 'Pago',
                        'comprobante_id' => $order->number,
                        'ingresos' =>  $datos['monto']
                    ]);
                }
          
                $ultimoRegistro = Movimiento::getUltimoMovimiento();
                $saldo = $ultimoRegistro[0]->saldo + $datos['monto'];

                if($datos['idFP'] != 1){
                    $datos['monto'] = 0;
                    $saldo = $ultimoRegistro[0]->saldo;
                }

                Movimiento::create([
                    'tipo_movimiento_id' => $datos['idTM'],
                    'payment_type_id' => $datos['idFP'],
                    'user_responsable_id' => HelpersController::getUserId(),
                    'description' => 'Movimiento Automático',
                    'comprobante_id' => $order->number,
                    'ingresos' => $datos['monto'],
                    'saldo' => $saldo
                ]);  

            }

           $urlRedirect = asset('ventas');
            
           return new JsonResponse([
                    'type' => 'success',
                    'msj' => 'Pagos agregados correctamente', 
                    'redirect' => $urlRedirect
            ]);   
            
        }
    }
}
