<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class createMenuTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateMenu()
    {
        $u1 = \App\User::create(array(
            'name' => 'menu',
            'email' => 'menu@email.com',
            'password' => bcrypt('password'),
        ));

        $entree = \App\RecetteType::create(array(
            'type_name' => 'entrée'
        ));

        $r1 = \App\Recette::create(array(
            'recettes_name' => "Cake me",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menel.",
            'image_url' => "http://img.cac.pmdstatic.net/fit/http.3A.2F.2Fwww.2Ecuisineactuelle.2Efr.2Fvar.2Fcui.2Fstorage.2Fimages.2Frecettes-de-cuisine.2Ftype-de-plat.2Fentree.2Fcake-aux-legumes-prisma_recipe-267589.2F2186154-1-fre-FR.2Fcake-aux-legumes.2Ejpg/748x372/crop-from/center/cake-aux-legumes.jpeg",
            'type_id' => $entree->id
        ));
        $r2= \App\Recette::create(array(
            'recettes_name' => "Taboanais",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de mena et sel.",
            'image_url' => "http://blog.carredeboeuf.com/wp-content/uploads/2015/04/taboul%C3%A9-persil-image.jpg",
            'type_id' => $entree->id
        ));

        $r3 = \App\Recette::create(array(
            'recettes_name' => "Taette",
            'description' => "1. 3 bouquets de persil plat.
                              2. 1 bouquet de menthe a et sel.",
            'image_url' => "http://img.over-blog-kiwi.com/0/93/14/90/20160621/ob_44a03f_tarte-spirale-carotte-courgette-quiche.jpg",
            'type_id' => $entree->id
        ));

        \App\Menu::create(array(
            'menu_title' => 'test menu',
            'user_id' => $u1->id,
            'entree_id' => $r1->id,
            'plat_id' => $r2->id,
            'dessert_id' => $r3->id,
        ));

        $this->assertDatabaseHas('menus', [
            'menu_title' => 'test menu'
        ]);
    }
}
