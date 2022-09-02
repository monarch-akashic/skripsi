<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string('job_name', 100);
            $table->mediumText('job_description');
            $table->mediumText('requirement');
            $table->string('age', 10);
            $table->string('salary', 50)->nullable();
            $table->string('workflow', 50)->nullable();
            $table->string('notes')->nullable();
            $table->string('status_open', 30);
            $table->string('working_hour', 20);
            $table->string('total_applicant', 5);
            $table->string('location');
            $table->decimal('latitude',8,6);
            $table->decimal('longitude', 9,6);
            $table->string('province', 50);
            $table->string('kota', 100);
            $table->string('kecamatan', 100);
            $table->string('kode_pos', 5);
            $table->string('tag')->nullable();
            $table->string('flag_block', 5)->nullable();
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
        Schema::dropIfExists('vacancies');
    }
}
