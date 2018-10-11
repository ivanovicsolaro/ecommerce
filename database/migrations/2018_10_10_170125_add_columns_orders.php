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
            $table->integer('client_id')->unsigned()->nullable()->after('billpayer_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('user_venta_id')->unsigned()->nullable()->after('client_id');
            $table->foreign('user_venta_id')->references('id')->on('users');
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
