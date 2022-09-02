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
            $table->string('postal_id', 10)->nullable();
            $table->string('subdis_id', 10)->nullable();
            $table->string('dis_id', 10)->nullable();
            $table->string('city_id', 10)->nullable();
            $table->string('prov_id', 10)->nullable();
            $table->string('postal_code', 5)->nullable();

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
