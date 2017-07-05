<?php

namespace Tests\Feature;

use App\Menu;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMenuCreateWithoutAuth()
    {
        $this->get("/menus/create")
            ->assertRedirect('/login');
    }

    public function testMenuCreate()
    {
        $user = new User(array('name' => "Elise"));
        $this->be($user);

        $this->get("/menus/create")
            ->assertSee("Créer un Menu")
            ->assertStatus(200);
    }

    public function testMenuDeleteWithoutAuth()
    {
        $this->get("/menus/delete/1")
            ->assertStatus(405);
    }

    public function testMenuDelete()
    {
        $user = \App\User::create(array(
            'name' => 'menu1',
            'email' => 'menu1@email.com',
            'password' => bcrypt('password'),
        ));
        $this->be($user);
        $plat = \App\RecetteType::create(array(
            'type_name' => 'Plat principal'
        ));

        $r1 = \App\Recette::create(array(
                    'recettes_name' => "recette 2",
                    'description' => "Quick desc 2",
                    'image_url' => "",
                    'type_id' => $plat->id
                ));
        $this->be($user);
        $menu = factory(Menu::class)->create([
            'user_id' => $user->id,
             'entree_id' => $r1->id,
             'plat_id' => $r1->id,
             'dessert_id' => $r1->id,
           ]);

        $menu1 = Menu::find($menu->id);
        $menu1->delete();
        $menu2 = Menu::find($menu->id);
        self::assertNull($menu2);
    }

    public function testMenuIndexWithoutAuth()
    {
        $this->get("menus/index")
            ->assertStatus(200); // error 404 handled
    }

    public function testMenuIndex()
    {
        $user = new User(array('name' => "Elise"));
        $this->be($user);

        $this->get("/menus/index")
            ->assertStatus(200); // error handled
    }

    public function testMenuShowWithoutAuth()
    {
        $this->get("menus/3")
            ->assertStatus(200); // error handled
    }

    public function testMenuShow()
    {
        $user = new User(array('name' => "Elise"));
        $this->be($user);

        $this->get("/menus/u")
            ->assertStatus(200)
            ->assertSee('404'); // error 404 handled
    }

    public function testMenuShowExist()
    {
        $user = \App\User::create(array(
            'name' => 'menu2',
            'email' => 'menu2@email.com',
            'password' => bcrypt('password')
        ));
        $plat = \App\RecetteType::create(array(
            'type_name' => 'Plat principal'
        ));

        $r1 = \App\Recette::create(array(
                    'recettes_name' => "recette",
                    'description' => "Quick desc",
                    'image_url' => "",
                    'type_id' => $plat->id
                ));
        $this->be($user);
        $menu = factory(Menu::class)->create([
            'user_id' => $user->id,
             'entree_id' => $r1->id,
             'plat_id' => $r1->id,
             'dessert_id' => $r1->id,
        ]);
        $this->assertDatabaseHas('menus',
            ['id' => $menu->id]
        );
    }
}
