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
        Schema::create('classe_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->boolean('status')->default(true);
            $table->integer('gradeID')->unsigned();
            $table->integer('classesID')->unsigned();
            $table->timestamps();

            $table->foreign('gradeID')->references('id')->on('grades')->cascadeOnDelete()
                    ->cascadeOnUpdate();

            $table->foreign('classesID')->references('id')->on('classes')->cascadeOnDelete()
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
        Schema::dropIfExists('classes');
    }
};
