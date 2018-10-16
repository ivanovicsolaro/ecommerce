<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Vanilo\Framework\Models\Customer;

use DB;

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
}
