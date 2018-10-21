<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Vanilo\Framework\Models\Customer;
use App\CuentaCorriente;

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

            Customer::create([
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
        return view('clientes.edit', compact('cliente'));
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
            $cliente = Customer::findOrFail(Crypt::decrypt($id));
            $cliente->firstname = $data['name'];
            $cliente->lastname = $data['apellido'];
            $cliente->registration_nr = $data['cuit'];
            $cliente->email = $data['email'];
            $cliente->phone = $data['phone'];
            $cliente->company_name = $data['company_name'];
            $cliente->type = $data['tipo'];
            $cliente->tax_nr = $data['tax_nr'];
            $cliente->is_active = $data['is_active'];

            $cliente->save();

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
