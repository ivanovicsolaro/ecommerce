<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Vanilo\Framework\Models\Customer;
use App\CuentaCorriente;
use App\Address;

use DB;
use Crypt;

class CustomerController extends Controller
{
    public function index()
    {
        $clientes = DB::table('customers')->paginate(15);

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');   
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

            $customer = Customer::create([
                'firstname' => $data['name'],
                'lastname' => $data['apellido'],
                'registration_nr' => $data['cuit'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'company_name' => $data['company_name'],
                'type' => $data['tipo'],
                'tax_nr' => $data['tax_nr'],
                'is_active' => $data['is_active']
            ]);


            
            $address = Address::create([
                            'country_id' => 1, //HARDCODEADO
                            'province_id' => 1, //HARDCODEADO
                            'postalcode' => $data['codigo_postal'],
                            'city' => $data['localidad'],
                            'address' => $data['calle'],
                            'number' => $data['numero'],
                            'piso' => $data['piso'],
                            'depto' => $data['depto']
                        ]);

                DB::table('customer_addresses')->insert(['customer_id' => $customer->id, 'address_id' => $address->id]);
        
        
            return new JsonResponse([
                'msj' => 'Usuario Creado Correctamente',
                'type' => 'success'
            ]);
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
        $cliente = Customer::findOrFail(Crypt::decrypt($id));

         $address = Customer::join('customer_addresses', 'customers.id', 'customer_addresses.customer_id')
                            ->join('addresses', 'addresses.id', 'customer_addresses.address_id')
                            ->join('countries', 'countries.id', 'addresses.country_id')
                            ->where('customers.id', $cliente->id)
                            ->select('addresses.*', 'countries.name as nombreCountry')
                            ->first();


        return view('clientes.edit', compact('cliente','address'));
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
        if($request->ajax()){

            $data = $request->all();
            $customer = Customer::findOrFail(Crypt::decrypt($id));
            $customer->firstname = $data['name'];
            $customer->lastname = $data['apellido'];
            $customer->registration_nr = $data['cuit'];
            $customer->email = $data['email'];
            $customer->phone = $data['phone'];
            $customer->company_name = $data['company_name'];
            $customer->type = $data['tipo'];
            $customer->tax_nr = $data['tax_nr'];
            $customer->is_active = $data['is_active'];

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
                            'postalcode' => $data['codigo_postal'],
                            'city' => $data['localidad'],
                            'address' => $data['calle'],
                            'number' => $data['numero'],
                            'piso' => $data['piso'],
                            'depto' => $data['depto']
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
        

            return new JsonResponse([
                'msj' => 'Usuario Editado Correctamente',
                'type' => 'success'
            ]);

        }
       
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

    public function find(Request $request){
        $client = Customer::where('firstname', 'LIKE', '%' . $request->get('query') . '%')
                ->orWhere('lastname', 'LIKE', '%' . $request->get('query') . '%')
                ->orWhere('registration_nr', 'LIKE', '%' . $request->get('query') . '%')
                ->get();

        if(count($client)>0){
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';

            foreach ($client as $c) {
               $output .= '<li id="list'.$c->id.'" onClick="seleccionar('.$c->id.')"><a>'.$c->firstname.' '.$c->lastname.' '.$c->registration_nr.'</a></li>';
            }

            $output .= '</ul>';

            echo $output;   
        }
         
    }

    public function viewCuentaCorriente($id){
        $id = Crypt::decrypt($id);

        $registros = CuentaCorriente::where('customer_id', $id)->orderBy('id', 'DESC')->paginate(25);

        $ingreso = CuentaCorriente::where('customer_id', $id)->sum('ingresos');

        $egreso = CuentaCorriente::where('customer_id', $id)->sum('egresos');

        return view('clientes.cuenta-corriente.index', compact('id', 'registros', 'ingreso', 'egreso'));
    }   

    public function createNota($id){

        return view('clientes.cuenta-corriente.create-nota', compact('id'));

    }

    public function storeNota(Request $request){

        if($request->ajax()){
            
            $data = $request->all();

            switch ($data['tipo_movimiento_id']) {
                case 3:
                    $ingresos = $data['monto'];
                    $egresos = 0;
                    $detalle = 'Nota de Credito';
                    break;

                case 4:
                    $ingresos = 0;
                    $egresos = $data['monto'];
                    $detalle = 'Nota de Debito';
                    break; 
            }

            CuentaCorriente::create([
                    'payment_type_id' => NULL,
                    'customer_id' => $data['id_cliente'],
                    'description' => $detalle.' - '.$data['motivo'],
                    'comprobante_id' => $data['nro_comprobante'],
                    'egresos' =>  $egresos,
                    'ingresos' => $ingresos
                ]);

            $urlRedirect = asset('clientes/cuenta-corriente/'.Crypt::encrypt($data['id_cliente']));

            return new JsonResponse([
                'msj' => 'Nota creada correctamente',
                'type' => 'success',
                'redirect' => $urlRedirect
            ]);



        }

    
    }
}
