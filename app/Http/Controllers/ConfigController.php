<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DB;
use Image;
use App\Banner;
use Illuminate\Support\Facades\Input;

class ConfigController extends Controller
{
    public function indexBanner(){
    	return view('config.index-banner');
    }

    public function updateBanner(Request $request){

    	$data = $request->all();
    	
    	$banner = Banner::find(1); 
      
    	$path = public_path('/img/banners/');
       
        

        for($i = 1; $i <= 10; $i++){

         	$title = 'title_banner_'.$i;
        	$url = 'url_banner_'.$i;
        	$name = 'banner_'.$i.'_file';

        	$banner->$title = $data['banner_'.$i.'_title'];
	    	$banner->$url = $data['banner_'.$i.'_url'];
	    	
	    }    

        


        
        $file = $request->file('banner_1_file');
        $filename = '1.'.$file->getClientOriginalExtension();
        $banner->name_file_banner_1 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(1200, 675);

        $file = $request->file('banner_2_file');
        $filename = '2.'.Input::file('banner_2_file')->getClientOriginalExtension();
        $banner->name_file_banner_2 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);

          $file = $request->file('banner_3_file');
        $filename = '3.'.Input::file('banner_3_file')->getClientOriginalExtension();
        $banner->name_file_banner_3 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);

          $file = $request->file('banner_4_file');
        $filename = '4.'.Input::file('banner_4_file')->getClientOriginalExtension();
        $banner->name_file_banner_4 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);

          $file = $request->file('banner_5_file');
        $filename = '5.'.Input::file('banner_5_file')->getClientOriginalExtension();
        $banner->name_file_banner_5 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);

          $file = $request->file('banner_6_file');
        $filename = '6.'.Input::file('banner_6_file')->getClientOriginalExtension();
        $banner->name_file_banner_6 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);

          $file = $request->file('banner_7_file');
        $filename = '7.'.Input::file('banner_7_file')->getClientOriginalExtension();
        $banner->name_file_banner_7 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);

          $file = $request->file('banner_8_file');
        $filename = '8.'.Input::file('banner_8_file')->getClientOriginalExtension();
        $banner->name_file_banner_8 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);

          $file = $request->file('banner_9_file');
        $filename = '9.'.Input::file('banner_9_file')->getClientOriginalExtension();
        $banner->name_file_banner_9 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);

          $file = $request->file('banner_10_file');
        $filename = '10.'.Input::file('banner_10_file')->getClientOriginalExtension();
        $banner->name_file_banner_10 = $filename;
        $file->move($path, $filename); 
        $img = Image::make(public_path('img/banners/'.$filename))->resize(50, 60);


 		$banner->save();
    }
}
