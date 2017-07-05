<?php

namespace Tests\Feature;

use App\Recette;
use App\User;
use Tests\CreatesApplication;
use Tests\TestCase;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuCreateTest extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    public $baseUrl = 'http://localhost:8000';
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMenuRoute()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/menus')
            ->assertResponseOk();
    }
}
