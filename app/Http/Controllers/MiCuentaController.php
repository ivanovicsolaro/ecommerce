<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vanilo\Order\Models\Order;
use Illuminate\Support\Facades\Auth;
use Vanilo\Framework\Models\Customer;
use DB;
use App\Address;
use App\User;

class MiCuentaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->limit(5)->get();
        return view('front.usuario.mi-cuenta', [
            'orders' => $orders
        ]);
    }
    
    public function getPerfil(){
        
        $result = DB::table('customer_users')
                        ->where('user_id', Auth::user()->id)
                        ->select('customer_id')
                        ->first();
            
        $customer = Customer::findOrFail($result->customer_id);

        $address = Customer::join('customer_addresses', 'customers.id', 'customer_addresses.customer_id')
                            ->join('addresses', 'addresses.id', 'customer_addresses.address_id')
                            ->join('countries', 'countries.id', 'addresses.country_id')
                            ->where('customers.id', $customer->id)
                            ->select('addresses.*', 'countries.name as nombreCountry')
                            ->first();
        
        return view('usuarios.perfil', [
            'customer' => $customer,
            'address' => $address
        ]);
    }
    /*
    public function postPerfil(Request $request){
        
        $result = DB::table('customer_users')
                        ->where('user_id', Auth::user()->id)
                        ->select('customer_id')
                        ->first();
        
        $customer = Customer::findOrFail($result->customer_id);

        $customer->firstname = $request->name;
        $customer->lastname = $request->lastname;
        $customer->phone = $request->phone;
        $customer->save();
        
        User::where('users.id', '=', Auth::user()->id)->update(['name' => $request->name]);
        
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
        
        return redirect ('perfil')->with('guardado', 'El perfil se ha actualizado correctamente.');
    }
    
    public function listPedidos(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(5);
        return view('front.usuario.pedidos', ['orders' => $orders]);
    }
    
    public function detallePedido($nro_pedido){
        $order = Order::where('number', $nro_pedido)->first();
        return view('front.usuario.detalle-pedido', ['order' => $order]);
    }
    
    public function getCambiarPassword(){
        return view('front.usuario.cambiar-contrasena');
    }
    
    public function postCambiarPassword(Request $request){
        $newpass = $request->get('new-pass');
        $reppass = $request->get('re-pass');
        
        if($newpass == $reppass){
            $idCliente = Auth::id();
            User::where('users.id', '=', $idCliente)->update(['password' => bcrypt($newpass)]);
            return redirect('/cambiar-contrasena')->with('guardado', 'La contraseña se ha modificado correctamente.');
        }else{
            return redirect('/cambiar-contrasena')->with('error', 'Las contraseñas ingresadas no coinciden.');
        }
    }*/
}
