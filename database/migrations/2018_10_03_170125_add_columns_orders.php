<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table){
            $table->string('costo_envio')->after('notes')->nullable();
            $table->string('plazo_envio')->after('costo_envio')->nullable();
            $table->integer('payment')->after('plazo_envio')->nullable();
            $table->integer('shipping')->after('billpayer_id')->nullable();
            $table->float('total_amount')->after('payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table){
            $table->dropColumn('costo_envio');
            $table->dropColumn('plazo_envio');
            $table->dropColumn('payment');
            $table->dropColumn('shipping');
        });
    }
}
