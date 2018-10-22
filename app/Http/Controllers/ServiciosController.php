<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Servicio;
use App\Customer;

use Carbon\Carbon;
use Crypt;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::paginate(15);
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicios.create');
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

            if($data['id_cliente'] == 1){
                return new JsonResponse(['type' => 'error', 'msj' => 'No ha seleccionado un cliente']);
            }

            Servicio::create([
                'customer_id' => $data['id_cliente'],
                'marca' => $data['marca'],
                'modelo' => $data['modelo'],
                'nro_serie' => $data['nro_serie'],
                'descripcion_falla' => $data['description'],
                'estado' => $data['estado'],
                'precio_presupuestado' => $data['precio_presupuestado']
            ]);
        }

        $urlRedirect = asset('servicios/');

        return new JsonResponse([
            'type' => 'success',
            'msj' => 'Servicio generado con éxito!',
            'redirect' => $urlRedirect
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio = Servicio::find(Crypt::decrypt($id));
        $nombre = $servicio->customer->lastname.', '.$servicio->customer->lastname;
        return view('servicios.show', compact('servicio','nombre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Servicio::find(Crypt::decrypt($id));
        $nombre = $servicio->customer->lastname.', '.$servicio->customer->lastname;
        return view('servicios.edit', compact('servicio','nombre'));
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

            $servicio = Servicio::findOrFail(Crypt::decrypt($id));

            $servicio->estado = $data['estado'];
            $servicio->precio_final = $data['precio_final'];
            $servicio->diagnostico = $data['diagnostico'];
            $servicio->detalle_mano_obra = $data['mano_obra'];

            $servicio->save();

            return new JsonResponse([
                'type' => 'success',
                'msj' => 'Servicio actualizado con éxito!',
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
}
