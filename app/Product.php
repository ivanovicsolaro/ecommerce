<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
	use Sluggable;

    protected $searchable = [
        'name',
        'description',
        'meta_keywords',
    ];
    
    protected $fillable = [
        'id', 'name', 'slug', 'sku', 'description', 'price', 'excerpt', 'state'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
}
