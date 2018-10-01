<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Vanilo\Framework\Models\Customer;
use Vanilo\Cart\Contracts\CartItem;
use Vanilo\Cart\Facades\Cart;

use Auth;
use DB;

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
}
