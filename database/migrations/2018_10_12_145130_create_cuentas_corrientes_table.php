<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasCorrientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_corrientes', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('payment_type_id')->nullable();
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('description')->nullable();
            $table->string('comprobante_id')->nullable();
            $table->decimal('ingresos', 15, 2);
            $table->decimal('egresos', 15, 2);
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
        Schema::dropIfExists('cuentas_corrientes');
    }
}
