<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\ProductsImages;
use Konekt\Enum\Eloquent\CastsEnums;
use Vanilo\Contracts\Buyable;
use Vanilo\Support\Traits\BuyableModel;



class Product extends Model implements Buyable
{
    use CastsEnums, Sluggable, SluggableScopeHelpers, BuyableModel;


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

    public function getImageUrl(){

    }

    public function getThumbnailUrl(){

    }

    public function hasImage(){
        
    }

    public function scopeBusqueda($query, $cadena){
        if($cadena != ''){
            $query->where('name', 'like', '%'.$cadena.'%')
                ->orWhere('description', 'like', '%'.$cadena.'%')
                ->get();
        }
    
    }

    public function scopeCategoria($query, $categoria_id){
        if($categoria_id != ''){
            $query->where('categorie_id', $categoria_id)->get();
        }
        
    }

    public function scopeSubcategoria($query, $subcategoria_id){
        if($subcategoria_id != ''){
            $query->where('subcategorie_id', $subcategoria_id)->get();
        }
    }
}
 