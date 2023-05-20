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
        Schema::create('books', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title');
            $table->string('file_name');
            $table->date('added_at')->default(date('Y/m/d'));
            $table->integer('gradeID')->unsigned();
            $table->integer('classID')->unsigned();
            $table->integer('teacherID')->unsigned();

            $table->foreign('gradeID')->references('id')->on('grades')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreign('classID')->references('id')->on('classes')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreign('teacherID')->references('id')->on('teachers')->onDelete('cascade')->cascadeOnUpdate();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
