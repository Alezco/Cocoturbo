<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // call our class and run our seeds
        $this->call('RecetteTypeSeeder');
        $this->command->info('Recette_type seeds finished.');
    }
}

class RecetteTypeSeeder extends Seeder {

    public function run() {

        // clear our database ------------------------------------------
        DB::table('recette_types')->delete();

        // seed our bears table -----------------------
        // we'll create three different bears

        // bear 1 is named Lawly. She is extremely dangerous. Especially when hungry.
        $entree = \App\Recette_type::create(array(
            'type_name'         => 'entrée'
        ));

        $plat = \App\Recette_type::create(array(
            'type_name'         => 'Plat principal'
        ));

        $dessert = \App\Recette_type::create(array(
            'type_name'         => 'Dessert'
        ));

        $this->command->info('Type de recette initialisé');

        // seed our fish table ------------------------
        // our fish wont have names... because theyre going to be eaten

        // we will use the variables we used to create the bears to get their id

        \App\Recette::create(array(
            'recettes_name'  => "Cake au légume",
            'type_id' => $entree->id
        ));
        \App\Recette::create(array(
            'recettes_name'  => "Taboulé libanais",
            'type_id' => $entree->id
        ));
        \App\Recette::create(array(
            'recettes_name'  => "Tarte courgette",
            'type_id' => $entree->id
        ));
        $this->command->info('Entree initialisé');
        \App\Recette::create(array(
            'recettes_name'  => "Potatoes maison",
            'type_id' => $plat->id
        ));
        \App\Recette::create(array(
            'recettes_name'  => "Chapon farcis au boudin blanc",
            'type_id' => $plat->id
        ));
        \App\Recette::create(array(
            'recettes_name'  => "Nouille chinoise et recette",
            'type_id' => $plat->id
        ));
        $this->command->info('Plat initialisé');
        \App\Recette::create(array(
            'recettes_name'  => "Tiramitsu",
            'type_id' => $dessert->id
        ));
        \App\Recette::create(array(
            'recettes_name'  => "Fraise et glace vanille",
            'type_id' => $dessert->id
        ));
        \App\Recette::create(array(
            'recettes_name'  => "Mille feuille au chocolat",
            'type_id' => $dessert->id
        ));
        $this->command->info('Dessert initialisé');
    }

}
