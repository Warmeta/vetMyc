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
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');
            $table->integer('number_clinic_history');
            $table->string('ref_animal');
            $table->string('specie');
            $table->mediumtext('clinic_history');
            $table->string('owner');
            $table->string('breed');
            $table->string('sex');
            $table->integer('age');
            $table->string('localization');
            $table->string('clinic_case_status');
            $table->string('sample')->unsigned();
            $table->string('bacterioscopy')->unsigned();
            $table->string('trichogram')->unsigned();
            $table->string('culture')->unsigned();
            $table->string('bacterial_isolate')->unsigned();
            $table->string('fungi_isolate')->unsigned();
            $table->string('antibiogram_sensitive')->unsigned();
            $table->string('antibiogram_intermediate')->unsigned();
            $table->string('antibiogram_resistant')->unsigned();
            $table->mediumtext('comment')->unsigned();
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
