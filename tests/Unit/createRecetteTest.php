<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class createRecetteTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRecetteSansUrl()
    {
        $u1 = \App\User::create(array(
            'name' => 'testRecette',
            'email' => 'testRecette@coco.fr',
            'password' => bcrypt('password'),
        ));

        $entree = \App\RecetteType::create(array(
            'type_name' => 'entrée'
        ));

        $r1 = \App\Recette::create(array(
            'recettes_name' => "Cake de test",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'type_id' => $entree->id,
            'url' => "anurl",
        ));

        $this->assertDatabaseHas('recettes', [
            'recettes_name' => 'cake de test'
        ]);
    }

    public function testRecetteAvecUrl()
    {
        $u1 = \App\User::create(array(
            'name' => 'testRecetteAvecUrl',
            'email' => 'testRecetteAvecUrl@coco.fr',
            'password' => bcrypt('password'),
        ));

        $entree = \App\RecetteType::create(array(
            'type_name' => 'entrée'
        ));

        $r1 = \App\Recette::create(array(
            'recettes_name' => "Cake de test avec url",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe fraîche.
                              3. 2 oignons nouveaux.
                              4. 2 à 3 tomates en grappe (les meilleures possible)
                              5. 2 à 3 càs de boulgour (gros ou fin, il s'agit de blé concassé, en épicerie, grande surfaces ou magasin bio)
                              6. le jus de 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://www.ateliercuisinesenior.com/wp-content/uploads/2012/06/fotolia_244565422.jpg",
            'type_id' => $entree->id,
        ));

        $this->assertDatabaseHas('recettes', [
            'recettes_name' => 'Cake de test avec url'
        ]);
    }

    public function testRecetteDeplicataTitle()
    {
        $u1 = \App\User::create(array(
            'name' => 'testRecetteAvecUrl',
            'email' => 'testRecetteAvecUrl@coco.fr',
            'password' => bcrypt('password'),
        ));

        $entree = \App\RecetteType::create(array(
            'type_name' => 'entrée'
        ));

        $r1 = \App\Recette::create(array(
            'recettes_name' => "Cake du duplicata",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouque 3 citrons jaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://ww/2012/06/fotolia_244565422.jpg",
            'type_id' => $entree->id,
        ));

        try {
            $r2 = \App\Recette::create(array(
                'recettes_name' => "Cake du duplicata",
                'description' => "1. 3 bouquunes.
                              7. huile d'olive vierge extra et sel.",
                'image_url' => "http://www.atelient/uploads/2012/06/fotolia_244565422.jpg",
                'type_id' => $entree->id,
            ));
        } catch(\Illuminate\Database\QueryException $ex){
                $this->assertContains('Cake du duplicata', $ex->getMessage());
                return;
        }
        $this->assertFalse(true);
    }
}
