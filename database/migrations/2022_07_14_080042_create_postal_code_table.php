<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_code', function (Blueprint $table) {
            $table->string('postal_id')->nullable();
            $table->string('subdis_id')->nullable();
            $table->string('dis_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('prov_id')->nullable();
            $table->string('postal_code')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postal_code');
    }
}
