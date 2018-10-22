<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DB;
use Image;
use File;
use Redirect;
use App\Banner;
use App\Setting;
use App\Product;

use Illuminate\Support\Facades\Input;



class ConfigController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('config.index');
    }
    
    public function indexBanner(){
        $banner = Banner::find(1);

    	return view('config.index-banner', compact('banner'));
    }

    public function updateBanner(Request $request){

    	$data = $request->all();
    	
    	$banner = Banner::find(1); 
      
    	$path = public_path('/img/banners/');

        for($i = 1; $i <= 10; $i++){
         	$title = 'title_banner_'.$i;
        	$url = 'url_banner_'.$i;
        	$name = 'banner_'.$i.'_file';
            $nameFile = 'name_file_banner_'.$i;

        	$banner->$title = $data['banner_'.$i.'_title'];
	    	$banner->$url = $data['banner_'.$i.'_url'];

            if(file_exists(public_path($i.'.png'))){
                File::delete(public_path($i.'.png'));
            }

            if(file_exists(public_path($i.'.jpg'))){
                File::delete(public_path($i.'.jpg'));
            }

            if($request->file($name)){
                $file = $request->file($name);
                $filename = $i.'.'.$file->getClientOriginalExtension();
                $banner->$nameFile = $filename;
                $file->move($path, $filename); 
                $img = Image::make(public_path('img/banners/'.$filename));
            }	
	    }    

        $banner->save();
            
        return redirect('banners');
 	
    }

    public function update(Request $request){
        if($request->ajax()){
            $data = $request->all();
            
            $setting = Setting::find('dolar');

            $productos_dolar = Product::where('if_dolar', 1)->get();

            foreach ($productos_dolar as $p) {
                $producto = Product::find($p->id);
                $producto->price = ceil(($p->price/$setting->value)*$data['dolar']);
                $producto->price_real = ceil(($p->price_real/$setting->value)*$data['dolar']);
                $producto->save();
            }

            $setting = Setting::find('dolar');
            $setting->value = $data['dolar'];
            $setting->save();

             return new JsonResponse([
                    'type' => 'success',
                    'msj' => 'Configuraciones actualizadas correctamente'
             ]);
        }
       
    }
}
