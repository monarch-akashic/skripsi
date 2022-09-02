<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('tagline', 100);
            $table->mediumText('description');
            $table->string('verified', 10)->nullable();
            $table->string('flag_block', 10)->nullable();
            $table->string('industry_type', 50);
            $table->string('company_size', 50);
            $table->string('company_type', 50)->nullable();
            $table->string('logo', 50);
            $table->mediumText('background');
            $table->string('website_link', 100)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
