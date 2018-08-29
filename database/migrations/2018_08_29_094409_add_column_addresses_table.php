<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('number')->nullable();
            $table->string('piso')->nullable();
            $table->string('depto')->nullable();
            $table->string('localidad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('number');
            $table->dropColumn('piso');
            $table->dropColumn('depto');
            $table->dropColumn('localidad');
        });
    }
}
