<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicCasesAntibioticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_cases_antibiotics', function(Blueprint $table) {
            $table->integer('antibiotic_id')->unsigned()->index();
            $table->foreign('antibiotic_id')->references('id')->on('antibiotics')->onDelete('cascade');
            $table->integer('clinic_case_id')->unsigned()->index();
            $table->foreign('clinic_case_id')->references('id')->on('clinic_cases')->onDelete('cascade');
            $table->boolean('resistant')->nullable();
            $table->boolean('intermediate')->nullable();
            $table->boolean('sensitive')->nullable();
            $table->primary(['antibiotic_id', 'clinic_case_id']);
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
        Schema::drop('clinic_cases_antibiotics');
    }
}
