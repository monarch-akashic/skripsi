<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applyings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacancy_id')->primary();
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('applicant_id')->primary();
            $table->foreign('applicant_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('current_user');
            $table->string('status');
            $table->string('interview_schedule')->nullable();
            $table->string('interview_location')->nullable();
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
        Schema::dropIfExists('applyings');
    }
}
