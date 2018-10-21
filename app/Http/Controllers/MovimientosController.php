<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Movimiento;
use App\TiposMovimiento;
use App\PaymentType;
use App\Http\Controllers\HelpersController;

use DB;

class MovimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimientos = DB::table('movimientos')
                        ->selectRaw('movimientos.* , payments_types.description as ptDes, tipos_movimientos.description as tmDes, users.name as userName ')
                        ->join('payments_types', 'movimientos.payment_type_id', '=', 'payments_types.id')
                        ->join('tipos_movimientos', 'tipos_movimientos.id', '=', 'movimientos.tipo_movimiento_id')
                        ->join('users', 'movimientos.user_responsable_id', '=', 'users.id')
                        ->orderBy('id', 'DESC')
                        ->paginate(15);

        return view('caja.index', compact('movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposPagos = PaymentType::pluck('description', 'id')->all();
        $tiposMovimientos = TiposMovimiento::pluck('description', 'id')->all();

        return view('caja.create', compact('tiposMovimientos', 'tiposPagos'));
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

            $ultimoRegistro = Movimiento::getUltimoMovimiento();

            if(in_array($data['tipo_movimiento_id'], array(1,2,8,10,11,13,14))){
                    $ingresos = 0;
                    $egresos =  $data['monto'];
                    $saldo = $ultimoRegistro[0]->saldo - $data['monto'];
            }else{
                 $ingresos =  $data['monto'];
                 $egresos = 0;
                 $saldo = $ultimoRegistro[0]->saldo + $data['monto'];
            }

           
           

            Movimiento::create([
                    'tipo_movimiento_id' => $data['tipo_movimiento_id'],
                    'payment_type_id' => 1,
                    'user_responsable_id' => HelpersController::getUserId(),
                    'description' => $data['motivo'],
                    'comprobante_id' => $data['nro_comprobante'],
                    'ingresos' => $ingresos,
                    'egresos' =>  $egresos,
                    'saldo' => $saldo
                    
                ]);

            $urlRedirect = asset('movimientos');

            return new JsonResponse([
                'msj' => 'Movimiento registrado correctamente',
                'type' => 'success',
                'redirect' => $urlRedirect
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
