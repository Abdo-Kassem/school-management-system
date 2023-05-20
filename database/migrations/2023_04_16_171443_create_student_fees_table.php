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
        Schema::create('student_fees', function (Blueprint $table) {
            
            $table->increments('id');
            $table->decimal('debit')->unsigned();
            $table->decimal('credit')->unsigned();
            $table->integer('studentID')->unsigned();
            $table->integer('study_feesID')->unsigned();
            $table->date('created_at');

            $table->foreign('studentID')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('study_feesID')->references('id')->on('study_fees')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_fees');
    }
};
