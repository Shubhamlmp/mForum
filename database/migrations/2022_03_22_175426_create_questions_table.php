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
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('que_id');
            $table->integer('cat_Que_id')->unsigned();
            $table->integer('add_User_id')->unsigned();
            $table->text('add_question');
            $table->text('slug')->unique();
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('cat_Que_id')->references('category_id')->on('categories');
            $table->foreign('add_User_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_ques');
    }
};
