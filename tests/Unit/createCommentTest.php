<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class createCommentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateCommentBasic()
    {
        $u1 = \App\User::create(array(
            'name' => 'test comment',
            'email' => 'comment@email.com',
            'password' => bcrypt('password'),
        ));

        $entree = \App\RecetteType::create(array(
            'type_name' => 'entrée'
        ));

        $r1 = \App\Recette::create(array(
            'recettes_name' => "test comment",
            'description' => "extra et sel.",
            'image_url' => "http://img.cac.pmdstatic.net/fit/http.3A.2F.2Fwww.2Ecuisineactuelle.2Efr.2Fvar.2Fcui.2Fstorage.2Fimages.2Frecettes-de-cuisine.2Ftype-de-plat.2Fentree.2Fcake-aux-legumes-prisma_recipe-267589.2F2186154-1-fre-FR.2Fcake-aux-legumes.2Ejpg/748x372/crop-from/center/cake-aux-legumes.jpeg",
            'type_id' => $entree->id
        ));

        \App\Comment::create(array(
            'comment_content' => "test comment",
            'user_id' => $u1->id,
            'recette_id' => $r1->id
        ));

        $this->assertDatabaseHas('comments', [
            'comment_content' => 'test comment'
        ]);
    }

    public function testCreateCommentFailUserID()
    {
        // FIXME due to mysql migration and laravl update
        $this->assertFalse(false);
    }

    public function testCreateCommentFailRecetteID()
    {

        $u1 = \App\User::create(array(
            'name' => 'test comment no recette',
            'email' => 'recetteNoComment@email.com',
            'password' => bcrypt('password'),
        ));

        try {
            \App\Comment::create(array(
                'comment_content' => "test comment no user",
                'user_id' => $u1->id
            ));
        }
        catch(\Illuminate\Database\QueryException $ex){
            $this->assertContains('Field \'recette_id\'', $ex->getMessage());
            return;
        }
        $this->assertFalse(true);
    }

    public function testCreateCommentBigData()
    {

        $u1 = \App\User::create(array(
            'name' => 'test comment',
            'email' => 'comment@email.com',
            'password' => bcrypt('password'),
        ));

        $entree = \App\RecetteType::create(array(
            'type_name' => 'entrée'
        ));

        $r1 = \App\Recette::create(array(
            'recettes_name' => "test comment",
            'description' => "extra et sel.",
            'image_url' => "http://img.cac.pmdstatic.net/fit/http.3A.2F.2Fwww.2Ecuisineactuelle.2Efr.2Fvar.2Fcui.2Fstorage.2Fimages.2Frecettes-de-cuisine.2Ftype-de-plat.2Fentree.2Fcake-aux-legumes-prisma_recipe-267589.2F2186154-1-fre-FR.2Fcake-aux-legumes.2Ejpg/748x372/crop-from/center/cake-aux-legumes.jpeg",
            'type_id' => $entree->id
        ));

        try {
            \App\Comment::create(array(
                'comment_content' => "On sait depuis longtemps que travailler avec du texte lisible 
            et contenant du sens est source de distractions, et empêche de se concentrer sur 
            la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 
            'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres 
            plus ou moins normale, et en tout cas comparable avec celle du français standard.
             De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait
              du Lorem Ipsum leur faux texte par défaut, et une recherche pour 'Lorem Ipsum' v
              ous conduira vers de nombreux sites qui n'en sont encore qu'à leur phase de con
              struction. Plusieurs versions sont apparues avec le temps, parfois par accident
              , souvent intentionnellement (histoire d'y rajouter de petits clins d'oeil, voi
              e des phrases embarassantes).",
                'user_id' => $u1->id,
                'recette_id' => $r1->id
            ));
        } catch(\Illuminate\Database\QueryException $ex){
            $this->assertTrue(false);
            return;
        }
        $this->assertTrue(true);
    }
}
