<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vanilo\Product\Models\Product;
use Illuminate\Http\JsonResponse;

class FrontController extends Controller
{
   	public function indexShop(){
   		$productos = Product::all();
    	return view('front.productos.shop', compact('productos'));
    }
}
