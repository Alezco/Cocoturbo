<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('recette_id')->unsigned();
            $table->string('comment_content');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('recette_id')->references('id')->on('recettes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
