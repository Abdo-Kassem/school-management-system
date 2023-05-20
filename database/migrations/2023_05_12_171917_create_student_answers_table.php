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
        Schema::create('student_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studentID')->unsigned();
            $table->integer('quizzID')->unsigned();
            $table->string('answersIndex');
            $table->float('grades')->unsigned();

            $table->foreign('studentID')->references('id')->on('students')->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('quizzID')->references('id')->on('quizzes')->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_answers');
    }
};
