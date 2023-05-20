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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('grades');
            $table->integer('subjectID')->unsigned();
            $table->integer('gradeID')->unsigned();
            $table->integer('classID')->unsigned();
            $table->integer('classroomID')->unsigned();
            $table->integer('teacherID')->unsigned();

            $table->foreign('subjectID')->references('id')->on('subjects')
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('gradeID')->references('id')->on('grades')
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('classID')->references('id')->on('classes')
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('classroomID')->references('id')->on('classe_rooms')
                    ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('teacherID')->references('id')->on('teachers')
                    ->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('quizzes');
    }
};
