<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->string('gender',20);
            $table->string('password',70);
            $table->date('birth_date');
            $table->string('academic_year');
            $table->softDeletes();
            $table->string('remember_token',70)->nullable();

            $table->integer('religionID')->unsigned();
            $table->foreign('religionID')->references('id')->on('religions')
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('nationalitie_ID')->unsigned();
            $table->foreign('nationalitie_ID')->references('id')->on('nationalities')->
                cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('bloodID')->unsigned();
            $table->foreign('bloodID')->references('id')->on('bloodes')
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('gradeID')->unsigned();
            $table->foreign('gradeID')->references('id')->on('grades')
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('classID')->unsigned();
            $table->foreign('classID')->references('id')->on('classes')
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('classroomID')->unsigned();
            $table->foreign('classroomID')->references('id')->on('classe_rooms')
                    ->restrictOnDelete()->onUpdate('cascade');
            
            $table->integer('parentID')->unsigned();
            $table->foreign('parentID')->references('id')->on('my_parents')
                    ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
