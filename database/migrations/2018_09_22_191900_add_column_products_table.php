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
        });
    }
}
