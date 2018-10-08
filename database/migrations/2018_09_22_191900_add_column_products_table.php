<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table){
            $table->integer('categorie_id')->unsigned()->after('name');
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->integer('subcategorie_id')->unsigned()->after('categorie_id');
            $table->foreign('subcategorie_id')->references('id')->on('subcategories');
            $table->integer('stock')->after('sku');
            $table->integer('min')->after('stock')->nullable();
            $table->integer('max')->after('min')->nullable();
            $table->decimal('price_real', 15, 2)->after('price');
            $table->boolean('if_dolar')->after('stock'); 
            $table->boolean('destacado')->after('price');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table){
            $table->dropColumn('categorie_id');
            $table->dropColumn('subcategorie_id');
            $table->dropColumn('stock');
            $table->dropColumn('max');
            $table->dropColumn('min');
            $table->dropColumn('price_real');
            $table->dropColumn('if_dolar');
            $table->dropColumn('destacado');
        });
    }
}
