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
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->string('sample')->nullable();
            $table->string('bacterioscopy')->nullable();
            $table->string('trichogram')->nullable();
            $table->string('culture')->nullable();
            $table->string('bacterial_isolate')->nullable();
            $table->string('fungi_isolate')->nullable();
            $table->mediumtext('comment')->nullable();
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
