<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DB;
use Image;
use File;
use Redirect;
use App\Banner;
use Illuminate\Support\Facades\Input;

class ConfigController extends Controller
{
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
}
