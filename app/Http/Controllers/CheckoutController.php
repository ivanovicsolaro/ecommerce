<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Vanilo\Framework\Models\Customer;
use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;

use Auth;
use DB;

use App\Product;
use App\Address;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest()){
            return view('auth.login');
        }else{


          $items = Cart::model()->items->all();

          foreach ($items as $item) {
            $imagen = DB::table('products_images')->where('product_id', $item->product->id)->first();
              $item->product->imagen =  '/img/products/'.$item->product->id.'/thumbnails/'.$imagen->name;
          }
            
            $result = DB::table('customer_users')
                        ->where('user_id', $this->getUserId())
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

    }


    public function finalizarPedido(Request $request){
           
        $stock = $this->validarStock();
        
        if($stock['stock']){
            
           $s = $this->reducirStock();
           //$mp = $request->medio_pago;
           $result = DB::table('customer_users')
                            ->where('user_id', $this->getUserId())
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

                }else{

                     $address = Address::findOrFail($idAddress);

                     $address[0]->postalcode =  $request->codigo_postal;
                     $address[0]->city = $request->localidad;
                     $address[0]->address = $request->calle;
                     $address[0]->number = $request->numero;
                     $address[0]->piso = $request->piso;
                     $address[0]->depto = $request->depto;

                     $address[0]->save();
                }
            
            $mtototal = number_format(Cart::total(),2);
            $mtototal = str_replace(",","",$mtototal);

            /* genero el pedido en estado pendiente */
            $nro_pedido = $this->getUserId().strftime("%d%m%g%H%M");

            $order = Order::create([
                'number' => $nro_pedido,
                'user_id' => $this->getUserId(),
                'shipping_address_id' => $address->id,
                'costo_envio' => $request->costo_envio_email,
                'plazo_envio' => $request->plazo_entrega_email,
                'payment' => 'nose',
                'shipping' => $request->radio,
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
            /**
            switch($mp){
                    case('todopago'):
                       
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
                    break;
                    case('contraentrega'):
                        return redirect('/retorno?trx=ok&operationid='.$nro_pedido.'&mp=ceft');
                        break;
                    case('efectivo'):
                        return redirect('/retorno?trx=ok&operationid='.$nro_pedido.'&mp=eft');
                        break;
            }
            */
            
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

    private function getUserId(){
        return Auth::id(); 
    }

     private function validarStock(){
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

     private function reducirStock(){
        foreach(Cart::model()->items->all() as $item){
            
            $p = Product::find($item->product->id);
            $p->stock -= $item->quantity;
            $p->save();
            
        }
        return 1;
    }
}
