<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_cases', function($table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->integer('number_clinic_history');
            $table->string('ref_animal');
            $table->string('specie');
            $table->long('clinic_history');
            $table->string('owner');
            $table->string('breed');
            $table->string('sex');
            $table->string('clinic_case_status');
            $table->string('sample')->nullable();
            $table->string('bacterioscopy')->nullable();
            $table->string('trichogram')->nullable();
            $table->string('culture')->nullable();
            $table->string('bacterial')->nullable();
            $table->string('fungus')->nullable();
            $table->long('comment')->nullable();
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
        Schema::drop('clinic_cases');
    }
}
