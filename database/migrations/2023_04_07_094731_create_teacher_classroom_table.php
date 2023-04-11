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
        Schema::create('teacher_classroom', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('classroomID')->unsigned();
           $table->integer('teacherID')->unsigned();

           $table->foreign('teacherID')->references('id')->on('teachers')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('classroomID')->references('id')->on('classe_rooms')
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
        Schema::dropIfExists('teacher_classroom_create');
    }
};
