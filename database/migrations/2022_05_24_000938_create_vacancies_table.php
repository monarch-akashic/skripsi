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
            $table->string('job_name');
            $table->longText('job_description');
            $table->longText('requirement');
            $table->string('age');
            $table->string('salary')->nullable();
            $table->string('workflow')->nullable();
            $table->string('notes')->nullable();
            $table->string('status_open');
            $table->string('working_hour');
            $table->string('total_applicant');
            $table->string('location');
            $table->decimal('latitude',8,6);
            $table->decimal('longitude', 9,6);
            $table->string('province');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kode_pos');
            $table->string('tag')->nullable();
            $table->string('flag_block')->nullable();
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
