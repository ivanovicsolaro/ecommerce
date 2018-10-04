<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_banner_1')->limit(30);
            $table->string('url_banner_1');
            $table->string('name_file_banner_1');

            $table->string('title_banner_2')->limit(30);
            $table->string('url_banner_2');
            $table->string('name_file_banner_2');

            $table->string('title_banner_3')->limit(30);
            $table->string('url_banner_3');
            $table->string('name_file_banner_3');

            $table->string('title_banner_4')->limit(30);
            $table->string('url_banner_4');
            $table->string('name_file_banner_4');

            $table->string('title_banner_5')->limit(30);
            $table->string('url_banner_5');
            $table->string('name_file_banner_5');

            $table->string('title_banner_6')->limit(30);
            $table->string('url_banner_6');
            $table->string('name_file_banner_6');

            $table->string('title_banner_7')->limit(30);
            $table->string('url_banner_7');
            $table->string('name_file_banner_7');

            $table->string('title_banner_8')->limit(30);
            $table->string('url_banner_8');
            $table->string('name_file_banner_8');

            $table->string('title_banner_9')->limit(30);
            $table->string('url_banner_9');
            $table->string('name_file_banner_9');

            $table->string('title_banner_10')->limit(30);
            $table->string('url_banner_10');
            $table->string('name_file_banner_10');  

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
        Schema::dropIfExists('banners');
    }
}
