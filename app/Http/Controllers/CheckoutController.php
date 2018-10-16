<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Vanilo\Framework\Models\Customer;
use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;
use Vanilo\Order\Models\Order;

use DB;
use Redirect;
use Auth;

use App\Product;
use App\Address;
use App\CuentaCorriente;

use App\Http\Controllers\HelpersController;

use App\Http\Requests\CheckOutRequest;

class CheckoutController extends Controller
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
        if(Auth::guest()){
            return redirect('login')->with('error', 'Debes estar logueado para finalizar la compra');
        }

        if(Cart::isEmpty()){
                return redirect('/shop')->with('error', 'No posees productos en tu carrito');
        }
        


          $items = Cart::model()->items->all();

          foreach ($items as $item) {
            $imagen = DB::table('products_images')->where('product_id', $item->product->id)->first();
             if(!$imagen){
                  $item->product->imagen = '/img/products/sin-imagen.jpg';
              }else{
                  $item->product->imagen =  '/img/products/'.$item->product->id.'/thumbnails/'.$imagen->name;
              }
          }
            
            $result = DB::table('customer_users')
                        ->where('user_id', HelpersController::getUserId())
                        ->select('customer_id')
                        ->first();
            
            $customer = Customer::findOrFail($result->customer_id);

            $address = Customer::join('customer_addresses', 'customers.id', 'customer_addresses.customer_id')
                                ->join('addresses', 'addresses.id', 'customer_addresses.address_id')
                                ->join('countries', 'countries.id', 'addresses.country_id')
                                ->where('customers.id', $customer->id)
                                ->select('addresses.*', 'countries.name as nombreCountry')
                              ->get();
        
            return view('front.checkout.checkout', ['customer' => $customer, 'address' => $address]);
       

    }


    public function finalizarPedido(CheckOutRequest $request){

        if(Cart::isEmpty()){
            return redirect('/shop')->with('error', 'No posees productos en tu carrito');;
        }

        $stock = HelpersController::validarStock();
        
        if($stock['stock']){
            
           $s = HelpersController::reducirStock();
           //$mp = ;
           $result = DB::table('customer_users')
                            ->where('user_id', HelpersController::getUserId())
                            ->select('customer_id')
                            ->first();

            $customer = Customer::findOrFail($result->customer_id);

            $customer->firstname = $request->firstname;
            $customer->lastname = $request->lastname;
            $customer->email = $request->email;
            $customer->phone = $request->phone;

            $customer->save();

            $idAddress = Customer::join('customer_addresses', 'customers.id', 'customer_addresses.customer_id')
                                    ->join('addresses', 'addresses.id', 'customer_addresses.address_id')    
                                    ->select('addresses.id')
                                    ->where('customers.id', $customer->id)
                                    ->first();

                if($idAddress == null){

                    $address = Address::create([
                                'country_id' => 1, //HARDCODEADO
                                'province_id' => 1, //HARDCODEADO
                                'postalcode' => $request->codigo_postal,
                                'city' => $request->localidad,
                                'address' => $request->calle,
                                'number' => $request->numero,
                                'piso' => $request->piso,
                                'depto' => $request->depto
                            ]);

                    DB::table('customer_addresses')->insert(['customer_id' => $customer->id, 'address_id' => $address->id]);

                       $idAddress = $address->id;

                }else{

                     $address = Address::findOrFail($idAddress);

                     $address[0]->postalcode =  $request->codigo_postal;
                     $address[0]->city = $request->localidad;
                     $address[0]->address = $request->calle;
                     $address[0]->number = $request->numero;
                     $address[0]->piso = $request->piso;
                     $address[0]->depto = $request->depto;

                     $address[0]->save();

                     $idAddress = $address[0]->id;
                }

            
            $mtototal = number_format(Cart::total(),2);
            $mtototal = str_replace(",","",$mtototal);

            /* genero el pedido en estado pendiente */
            $nro_pedido = HelpersController::getUserId().strftime("%d%m%g%H%M");

            $order = Order::create([
                'number' => $nro_pedido,
                'user_id' => HelpersController::getUserId(),
                'customer_id' => $result->customer_id,
                'shipping_address_id' =>  $idAddress,
                'costo_envio' => '70.00',
                'plazo_envio' => '1 dia',
                'payment' => $request->medio_pago,
                'shipping' => $request->envio,// $request->radio,
                'total_amount' => $mtototal + $request->costo_envio_email
            ]);

            /*agrego los productos al pedido*/
            foreach(Cart::model()->items->all() as $item){

                $product = Product::find($item->product->id);

                $order->items()->create([
                    'product_type' => 'product',
                    'product_id'   => $product->id,
                    'price'        => $product->price,
                    'name'         => $product->name,
                    'quantity'     => $item->quantity,
                ]);
            }

            $ultimoRegistro = CuentaCorriente::getUltimoRegistro($result->customer_id);
            CuentaCorriente::create([
                'payment_type_id' => NULL,
                'customer_id' => $result->customer_id,
                'description' => 'Venta Web',
                'comprobante_id' => $nro_pedido,
                'egresos' =>  $mtototal
            ]);
            
            
            switch($request->medio_pago){
                  /*  case('todopago'):
                       
                        $nombre_producto = $this->getTPproductos();
                        $codigos_productos = $this->getTPCodigosProductos();
                        $cantidades_productos = $this->getTPCantidadProductos();
                        $precios_productos = $this->getTPPreciosProductos();
                        $total_por_producto = $this->getTPTotalPorProducto();
                        $url = Config::get('app.url');
                        $precio_total = Cart::total() + $request->costo_envio_email;
                        return view('payments.form-todopago',[
                            'nro_pedido' => $nro_pedido,
                            'precio_total' => number_format($precio_total, 2, '.', ''),
                            'email_cliente' => $customer->email,
                            'ciudad' => $address->first()->city,
                            'userid' => $this->getUserId(),
                            'nombre' => $customer->firstname,
                            'apellido' => $customer->lastname,
                            'telefono' => $customer->phone,
                            'codigo_postal' => $address->first()->postalcode,
                            'codigo_provincia' => 'B',
                            'direccion' => $address->first()->address.' '.$address->first()->number,
                            'productos' => $nombre_producto,
                            'codigo' => $codigos_productos,
                            'cantidad' => $cantidades_productos,
                            'precios' => $precios_productos,
                            'total_producto' => $total_por_producto,
                            'url' => $url
                        ]);
                    break;*/
                    case('1'):
                        Cart::clear();
                         return view('front.checkout.finalizado', ['nroPedido' => $nro_pedido, 'rta' => 'ok', 'mp' => $request->medio_pago]);
                        break;
                    case('2'):
                        Cart::clear();
                       return view('front.checkout.finalizado', ['nroPedido' => $nro_pedido, 'rta' => 'ok', 'mp' => $request->medio_pago]);
                        break;
            }
            
            
        }else{
            return redirect('checkout')->with('error', $stock['producto']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
