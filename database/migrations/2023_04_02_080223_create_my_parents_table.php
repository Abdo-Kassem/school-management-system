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
        Schema::create('my_parents', function (Blueprint $table) {

            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('remember_token',70)->nullable();

            //father information

            $table->string('fatherName');
            $table->string('fatherPhone',15);
            $table->string('fatherNationalID',20);
            $table->string('fatherJob',255);
            $table->string('fatherAddress');

            $table->integer('fatherBloodeID')->unsigned();
            $table->integer('fatherReligionsID')->unsigned();
            $table->integer('fatherNationalityID')->unsigned();

            //mother information

            $table->string('motherName');
            $table->string('motherPhone',15);
            $table->string('motherNationalID',20);
            $table->string('motherJob',255);
            $table->string('motherAddress');

            $table->integer('motherBloodeID')->unsigned();
            $table->integer('motherReligionsID')->unsigned();
            $table->integer('motherNationalityID')->unsigned();

            //relations

            $table->foreign('fatherBloodeID')->references('id')->on('bloodes')->
                    cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('fatherReligionsID')->references('id')->on('religions')->
                    cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('fatherNationalityID')->references('id')->on('nationalities')->
                    cascadeOnDelete()->cascadeOnUpdate();
            
            $table->foreign('motherBloodeID')->references('id')->on('bloodes')->
                    cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('motherReligionsID')->references('id')->on('religions')->
                    cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('motherNationalityID')->references('id')->on('nationalities')->
                    cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_parents');
    }
};
