<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Client;

use DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $client = DB::table('clients')  
                ->where('name', 'LIKE', '%' . $request->get('query') . '%')
                ->orWhere('lastname', 'LIKE', '%' . $request->get('query') . '%')
                ->orWhere('cuit', 'LIKE', '%' . $request->get('query') . '%')
                ->get();

        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';

        foreach ($client as $c) {
           $output .= '<li><a href="#">'.$c->name.', '.$c->lastname.' ('.$c->cuit.')</a></li>';
        }

        $output .= '</ul>';

        echo $output;      
    }   
}
