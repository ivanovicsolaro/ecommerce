<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('marca');
            $table->string('modelo');
            $table->string('nro_serie');
            $table->string('descripcion_falla');
            $table->string('diagnostico');
            $table->string('detalle_mano_obra');
            $table->string('estado');
            $table->decimal('precio_presupuestado', 15, 2);
            $table->decimal('precio_final', 15, 2);
            $table->date('vencimiento');
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
        Schema::dropIfExists('servicios');
    }
}
