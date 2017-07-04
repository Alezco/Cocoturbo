<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('entree_id')->unsigned();
            $table->integer('plat_id')->unsigned();
            $table->integer('dessert_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('entree_id')->references('id')->on('recettes');
            $table->foreign('plat_id')->references('id')->on('recettes');
            $table->foreign('dessert_id')->references('id')->on('recettes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
