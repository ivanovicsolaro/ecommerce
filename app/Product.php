<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\ProductsImages;


class Product extends Model
{
	use Sluggable;
    use SluggableScopeHelpers;

    protected $searchable = [
        'name',
        'description',
        'meta_keywords',
    ];

    protected $table = "products";
    
    protected $fillable = [
        'id', 'name', 'slug', 'sku', 'stock', 'description', 'price', 'excerpt', 'state', 'categorie_id', 'subcategorie_id'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function productImages(){
        return $this->hasMany(ProductsImages::class);
    }
}
 