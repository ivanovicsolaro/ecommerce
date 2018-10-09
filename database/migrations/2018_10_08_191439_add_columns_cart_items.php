<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCartItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items',  function (Blueprint $table){
            $table->decimal('price_real', 15, 2)->after('price');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items',  function (Blueprint $table){
            $table->dropColumn('price_real');
        });
    }
}
