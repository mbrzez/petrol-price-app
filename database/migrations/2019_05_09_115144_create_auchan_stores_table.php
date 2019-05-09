<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuchanStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auchan_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('external_id');
            $table->string('name');
            $table->string('city');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('sub_url');
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
        Schema::dropIfExists('auchan_stores');
    }
}
