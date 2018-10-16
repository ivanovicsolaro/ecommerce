<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_movimiento_id')->unsigned();
            $table->foreign('tipo_movimiento_id')->references('id')->on('tipos_movimientos');
            $table->integer('payment_type_id')->unsigned();
            $table->foreign('payment_type_id')->references('id')->on('payments_types');
            $table->integer('user_responsable_id')->unsigned()->nullable();
            $table->foreign('user_responsable_id')->references('id')->on('users');
            $table->string('description');
            $table->string('comprobante_id');
            $table->decimal('ingresos', 15, 2);
            $table->decimal('egresos', 15, 2);
            $table->decimal('saldo', 15, 2);
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
