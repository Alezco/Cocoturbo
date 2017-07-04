<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Recette::class, function(Faker\Generator $faker) {
   return [
       'recettes_name' => $faker->name,
       'description' => $faker->text(),
       'type_id' => 1,
       'created_at' => $faker->date(),
       'updated_at' => $faker->date(),
       'image_url' => ""
   ];
});

$factory->define(App\Menu::class, function(Faker\Generator $faker) {
   return [
      'user_id' => 6,
       'entree_id' => 15,
       'plat_id' => 16,
       'dessert_id' => 17,
       'updated_at' => $faker->date('y-m-d', 'now'),
       'created_at' => $faker->date('y-m-d', 'updated_at'),
       'menu_title' => str_random()
   ] ;
});
