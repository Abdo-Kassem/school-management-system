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
        Schema::create('study_fees', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('name');
            $table->text('notes');
            $table->decimal('value')->unsigned();
            $table->string('acadimic_year',8);
            $table->integer('gradeID')->unsigned();
            $table->integer('classID')->unsigned();
            $table->tinyInteger('type')->unsigned();

            $table->foreign('gradeID')->references('id')->on('grades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('classID')->references('id')->on('classes')->cascadeOnDelete()->cascadeOnUpdate();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_fees');
    }
};
