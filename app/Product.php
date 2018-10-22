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
        'id', 'name', 'slug', 'sku', 'stock', 'description', 'price', 'excerpt', 'state', 'categorie_id', 'subcategorie_id', 'price_real', 'destacado', 'if_dolar', 'min', 'max', 'path_image'
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
        if(isset($categoria_id)){          
            $query->whereIn('categorie_id', $categoria_id)->get();
        }
        
    }

    public function scopeSubcategoria($query, $subcategoria_id){
        if(isset($subcategoria_id)){
            $query->whereIn('subcategorie_id', $subcategoria_id)->get();
        }
    }

    public static function findBySku($sku){
        return Product::where('sku', $sku)->get();
    }
}
 