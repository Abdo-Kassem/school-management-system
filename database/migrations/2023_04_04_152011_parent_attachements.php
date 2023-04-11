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
        Schema::create('parent_attachements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fileName');
            $table->integer('parentID')->unsigned();
            $table->timestamp('added_at');

            $table->foreign('parentID')->references('id')->on('my_parents')->
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
        //
    }
};
