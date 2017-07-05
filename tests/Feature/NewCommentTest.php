<?php

namespace Tests\Feature;

use App\Recette;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\CreatesApplication;
use Tests\TestCase;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewCommentTest extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;
    public $baseUrl = 'http://localhost:8000';
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccessRecetteDetailWithAuth()
    {
        DB::beginTransaction();
        $user = factory(User::class)->create();

        $type = \App\RecetteType::create(array(
            'type_name' => 'Plat principal'
        ));

        $r1 = Recette::create(array(
            'recettes_name' => "CdettmewithAuth",
            'description' => "1. 3 bjaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://img.cac.pmdstatic.net/fit/http.3A.2F.2Fwww.2Ecuisineactuelle.2Efr.2Fvar.2Fcui.2Fstorage.2Fimages.2Frecettes-de-cuisine.2Ftype-de-plat.2Fentree.2Fcake-aux-legumes-prisma_recipe-267589.2F2186154-1-fre-FR.2Fcake-aux-legumes.2Ejpg/748x372/crop-from/center/cake-aux-legumes.jpeg",
            'type_id' => $type->id
        ));

        $this->actingAs($user)
            ->visit('/recettes/'.$r1->id)
            ->assertResponseOk();
        DB::rollback();
    }

    public function testAccessRecetteDetailWithAuthseeComment()
    {
        DB::beginTransaction();
        $user = factory(User::class)->create();

        $type = \App\RecetteType::create(array(
            'type_name' => 'Plat principal'
        ));

        $r1 = Recette::create(array(
            'recettes_name' => "CdetesAuthseeComment",
            'description' => "1. 3 bjaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://img.cac.pmdstatic.net/fit/http.3A.2F.2Fwww.2Ecuisineactuelle.2Efr.2Fvar.2Fcui.2Fstorage.2Fimages.2Frecettes-de-cuisine.2Ftype-de-plat.2Fentree.2Fcake-aux-legumes-prisma_recipe-267589.2F2186154-1-fre-FR.2Fcake-aux-legumes.2Ejpg/748x372/crop-from/center/cake-aux-legumes.jpeg",
            'type_id' => $type->id
        ));

        $this->actingAs($user)
            ->visit('/recettes/'.$r1->id)
            ->assertResponseOk()
            ->see('Commentaire');
        DB::rollback();
    }

    public function testAccessRecetteDetailWithAuthPostCommentWellRedirect()
    {
        DB::beginTransaction();
        $u1 = \App\User::create(array(
            'name' => 'User2Test',
            'email' => 'User2Test@email.com',
            'password' => bcrypt('password'),
        ));

        $type = \App\RecetteType::create(array(
            'type_name' => 'Plpal'
        ));

        $r1 = Recette::create(array(
            'recettes_name' => "CommentNoCkhuuhkkontent",
            'description' => "1. 3 bjaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://img.cac.pmdstatic.net/fit/http.3A.2F.2Fwww.2Ecuisineactuelle.2Efr.2Fvar.2Fcui.2Fstorage.2Fimages.2Frecettes-de-cuisine.2Ftype-de-plat.2Fentree.2Fcake-aux-legumes-prisma_recipe-267589.2F2186154-1-fre-FR.2Fcake-aux-legumes.2Ejpg/748x372/crop-from/center/cake-aux-legumes.jpeg",
            'type_id' => $type->id
        ));

        $this->actingAs($u1)
            ->visit('/recettes/'.$r1->id)
            ->assertResponseOk()
            ->see('Commentaire')
            ->type('my content', 'content')
            ->press('Poster le commentaire')
            ->assertResponseOk();

        $this->actingAs($u1)
            ->visit('/recettes/'.$r1->id)
            ->assertResponseOk()
            ->See('text-muted');
        DB::rollback();
    }

    public function testAccessRecetteDetailWithAuthPostCommentNoContent()
    {
        DB::beginTransaction();
        $u1 = \App\User::create(array(
            'name' => 'User1Test',
            'email' => 'User1Test@email.com',
            'password' => bcrypt('password'),
        ));

        $type = \App\RecetteType::create(array(
            'type_name' => 'Plpal'
        ));

        $r1 = Recette::create(array(
            'recettes_name' => "CommentNoContent",
            'description' => "1. 3 bjaunes.
                              7. huile d'olive vierge extra et sel.",
            'image_url' => "http://img.cac.pmdstatic.net/fit/http.3A.2F.2Fwww.2Ecuisineactuelle.2Efr.2Fvar.2Fcui.2Fstorage.2Fimages.2Frecettes-de-cuisine.2Ftype-de-plat.2Fentree.2Fcake-aux-legumes-prisma_recipe-267589.2F2186154-1-fre-FR.2Fcake-aux-legumes.2Ejpg/748x372/crop-from/center/cake-aux-legumes.jpeg",
            'type_id' => $type->id
        ));

        $this->actingAs($u1)
            ->visit('/recettes/'.$r1->id)
            ->assertResponseOk()
            ->see('Commentaire')
            ->press('Poster le commentaire')
            ->assertResponseOk();

        $this->actingAs($u1)
            ->visit('/recettes/'.$r1->id)
            ->assertResponseOk()
            ->dontSee('text-muted');
        DB::rollback();
    }
}
