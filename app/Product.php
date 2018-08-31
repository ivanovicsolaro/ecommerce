<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Vanilo\Contracts\Buyable;
use Vanilo\Product\Models\Product as BaseProduct;
use Vanilo\Support\Traits\BuyableModel;
use Vanilo\Support\Traits\BuyableImageSpatieV7;


class Product extends BaseProduct implements Buyable, HasMedia
{
	//use Sluggable;
     use BuyableModel; // Implements Buyable methods for common Eloquent models
    use BuyableImageSpatieV7; // Implements Buyable's image methods using Spatie Media Library
    use HasMediaTrait; // Spatie package's default trait

    protected $searchable = [
        'name',
        'description',
        'meta_keywords',
    ];
    
    protected $fillable = [
        'id', 'name', 'slug', 'sku', 'description', 'price', 'excerpt', 'state'
    ];

  /*  public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
   */
}
 