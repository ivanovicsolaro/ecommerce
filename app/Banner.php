<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
    	'title_banner_1', 'url_banner_1', 'name_file_banner_1', 
    	'title_banner_2', 'url_banner_2', 'name_file_banner_2', 
    	'title_banner_3', 'url_banner_3', 'name_file_banner_3', 
    	'title_banner_4', 'url_banner_4', 'name_file_banner_4', 
    	'title_banner_5', 'url_banner_5', 'name_file_banner_5', 
    	'title_banner_6', 'url_banner_6', 'name_file_banner_6', 
    	'title_banner_7', 'url_banner_7', 'name_file_banner_7', 
    	'title_banner_8', 'url_banner_8', 'name_file_banner_8', 
    	'title_banner_9', 'url_banner_9', 'name_file_banner_9', 
    	'title_banner_10', 'url_banner_10', 'name_file_banner_10'];
}
