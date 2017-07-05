<?php

namespace Tests\Feature;

use App\User;
use Tests\CreatesApplication;
use Tests\TestCase;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewRecetteTest extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    public $baseUrl = 'http://localhost:8000';
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccessWithAuth()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/recettes/create')
            ->assertResponseOk();
    }

    public function testAccessWithAuthAndTypeValid()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/recettes/create')
            ->type('myAutomaticrecette', 'name')
            ->type('a description', 'description')
            ->type('http://anImage.png', 'image')
            ->press('Créer la recette !')
            ->assertResponseOk();

        $this->visit('/recettes')
            ->see('myAutomaticrecette');
    }

    public function testAccessWithAuthAndTypeinValid()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/recettes/create')
            ->type('', 'name')
            ->type('a description from an invalid test', 'description')
            ->type('http://anImage.png', 'image')
            ->press('Créer la recette !')
            ->assertResponseOk();

        $this->visit('/recettes')
            ->dontsee('invalid test');
    }

    public function testAccessWithAuthAndTypeValidnoUrl()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/recettes/create')
            ->type('a valid test', 'name')
            ->type('a description from an valid test', 'description')
            ->press('Créer la recette !')
            ->assertResponseOk();

        $this->visit('/recettes')
            ->see('valid test');
    }

    public function testAccessWithAuthAndTypeinValidnoDescription()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/recettes/create')
            ->type('a invalid description', 'name')
            ->press('Créer la recette !')
            ->assertResponseOk();

        $this->visit('/recettes')
            ->dontSee('a invalid description');
    }
}
