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
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('gradeID')->unsigned();
            $table->integer('classID')->unsigned();
            $table->integer('teacherID')->unsigned();
            $table->date('created_at')->default(date('Y/m/d'));

            $table->foreign('gradeID')->references('id')->on('grades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('classID')->references('id')->on('classes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('teacherID')->references('id')->on('teachers')->cascadeOnDelete()->cascadeOnUpdate();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
