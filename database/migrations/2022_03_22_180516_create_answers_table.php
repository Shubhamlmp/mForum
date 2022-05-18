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
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('a_id');
            $table->integer('ans_User_id')->unsigned();
            $table->integer('ans_Que_id')->unsigned();
            $table->longText('add_answer');
            $table->timestamps();

            $table->foreign('ans_Que_id')->references('que_id')->on('questions');
            $table->foreign('ans_User_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_ans');
    }
};
