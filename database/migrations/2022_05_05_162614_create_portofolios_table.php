<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortofoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('profile_image', 50);
            $table->json('education');
            $table->json('experience');
            $table->json('skills', 50);
            $table->string('location')->nullable();
            $table->decimal('latitude',8,6)->nullable();
            $table->decimal('longitude', 9,6)->nullable();
            $table->string('portofolio_file',50);
            $table->string('cv_file', 50);
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
        Schema::dropIfExists('portofolios');
    }
}
