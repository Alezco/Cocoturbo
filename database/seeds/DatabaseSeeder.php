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

    public function run()
    {

        // clear our database ------------------------------------------
        DB::table('recette_types')->delete();
        DB::table('recettes')->delete();
        DB::table('users')->delete();
        DB::table('comments')->delete();
        DB::table('favorites')->delete();
        DB::table('menus')->delete();

        $u1 = \App\User::create(array(
            'name' => 'User1',
            'email' => 'user1@email.com',
            'password' => bcrypt('password'),
        ));

        $u2 = \App\User::create(array(
            'name' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('password'),
        ));

        // we'll create three different bears

        // bear 1 is named Lawly. She is extremely dangerous. Especially when hungry.
        $entree = \App\RecetteType::create(array(
            'type_name' => 'entrée'
        ));

        $plat = \App\RecetteType::create(array(
            'type_name' => 'Plat principal'
        ));

        $dessert = \App\RecetteType::create(array(
            'type_name' => 'Dessert'
        ));

        $this->command->info('Type de recette initialisé');

        // seed our fish table ------------------------
        // our fish wont have names... because theyre going to be eaten
        // we will use the variables we used to create the bears to get their id

        $r1 = \App\Recette::create(array(
            'recettes_name' => "Cake au légume",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://img.cac.pmdstatic.net/fit/http.3A.2F.2Fwww.2Ecuisineactuelle.2Efr.2Fvar.2Fcui.2Fstorage.2Fimages.2Frecettes-de-cuisine.2Ftype-de-plat.2Fentree.2Fcake-aux-legumes-prisma_recipe-267589.2F2186154-1-fre-FR.2Fcake-aux-legumes.2Ejpg/748x372/crop-from/center/cake-aux-legumes.jpeg",
            'type_id' => $entree->id
        ));
        $r2= \App\Recette::create(array(
            'recettes_name' => "Taboulé libanais",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://blog.carredeboeuf.com/wp-content/uploads/2015/04/taboul%C3%A9-persil-image.jpg",
            'type_id' => $entree->id
        ));
        $r3 = \App\Recette::create(array(
            'recettes_name' => "Tarte courgette",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://img.over-blog-kiwi.com/0/93/14/90/20160621/ob_44a03f_tarte-spirale-carotte-courgette-quiche.jpg",
            'type_id' => $entree->id
        ));
        $this->command->info('Entree initialisé');
        \App\Recette::create(array(
            'recettes_name' => "Potatoes maison",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://www.lesfoodies.com/_recipeimage/58367/potatoes-maison-1.jpg",
            'type_id' => $plat->id
        ));
        \App\Recette::create(array(
            'recettes_name' => "Chapon farcis au boudin blanc",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "https://images.marmitoncdn.org/recipephotos/multiphoto/69/69849463-8cd2-4287-9cdf-7eed853b03d5_normal.jpg",
            'type_id' => $plat->id
        ));
        \App\Recette::create(array(
            'recettes_name' => "Nouille chinoise",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://www.lijiangrestaurant.com/public/img/big/DSC_0029%20(Copier).JPG",
            'type_id' => $plat->id
        ));
        $this->command->info('Plat initialisé');
        \App\Recette::create(array(
            'recettes_name' => "Tiramitsu",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "https://t4.ftcdn.net/jpg/00/27/95/31/240_F_27953197_Aq9HLGqJ2jPL78IOU0Hbu6LwTIBJPxkP.jpg",
            'type_id' => $dessert->id
        ));
        \App\Recette::create(array(
            'recettes_name' => "Fraise et glace vanille",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://img.facv.pmdstatic.net/fit/http.3A.2F.2Fdata.2Evodemotion.2Ecom.2F979.2F979.2Ejpg/1280x720/quality/80/verrines-de-fraises-vanille-croustillant-amande.jpg",
            'type_id' => $dessert->id
        ));
        \App\Recette::create(array(
            'recettes_name' => "Mille feuille au chocolat",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "https://www.atelierdeschefs.com/media/recette-d24936-mille-feuilles-au-chocolat.jpg",
            'type_id' => $dessert->id
        ));
        $this->command->info('Dessert initialisé');

        \App\Comment::create(array(
            'comment_content' => "j'ai faim",
            'user_id' => $u1->id,
            'recette_id' => $r1->id
        ));

        \App\Favorite::create(array(
            'user_id' => $u1->id,
            'recette_id' => $r2->id
        ));

        \App\Favorite::create(array(
            'user_id' => $u1->id,
            'recette_id' => $r1->id
        ));

        \App\Favorite::create(array(
            'user_id' => $u2->id,
            'recette_id' => $r3->id
        ));

        \App\Menu::create(array(
            'menu_title' => 'Super menu',
            'user_id' => $u1->id,
            'entree_id' => $r1->id,
            'plat_id' => $r2->id,
            'dessert_id' => $r3->id,
        ));

    }

}
