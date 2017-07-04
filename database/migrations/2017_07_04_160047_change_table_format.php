<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE users ENGINE = InnoDB');
        DB::statement('ALTER TABLE recettes ENGINE = InnoDB');
        DB::statement('ALTER TABLE recette_types ENGINE = InnoDB');
        DB::statement('ALTER TABLE menus ENGINE = InnoDB');
        DB::statement('ALTER TABLE favorites ENGINE = InnoDB');
        DB::statement('ALTER TABLE comments ENGINE = InnoDB');
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
}
