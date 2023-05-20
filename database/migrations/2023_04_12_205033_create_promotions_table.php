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
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('studentIDs',1000);
            $table->integer('gradeID_from')->unsigned();
            $table->integer('classID_from')->unsigned();
            $table->integer('gradeID_to')->unsigned();
            $table->integer('classID_to')->unsigned();
            $table->timestamps();

            $table->foreign('gradeID_from')->references('id')->on('grades')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('classID_from')->references('id')->on('classes')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('gradeID_to')->references('id')->on('grades')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('classID_to')->references('id')->on('classes')
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
        Schema::dropIfExists('promotions');
    }
};
