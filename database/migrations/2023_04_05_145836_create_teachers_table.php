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
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',150)->unique();
            $table->string('password',70);
            $table->string('name');
            $table->string('phone',11)->unique();
            $table->float('salary')->nullable();
            $table->string('address');
            $table->string('gender',30);
            $table->string('remember_token',70)->nullable();
            $table->integer('specializationID')->unsigned();
            $table->integer('gradeID')->unsigned();
            $table->timestamp('joining_date');

            $table->foreign('specializationID')->references('id')->on('specializations')
                    ->cascadeOnDelete()->cascadeOnUpdate();
        
            $table->foreign('gradeID')->references('id')->on('grades')
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
        Schema::dropIfExists('teachers');
    }
};
