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

    public function testMenuDeleteWithoutAuth()
    {
        $this->get("/menus/delete/1")
            ->assertStatus(405);
    }

    public function testMenuIndexWithoutAuth()
    {
        $this->get("menus/index")
            ->assertStatus(200); // error 404 handled
    }

    public function testMenuShowWithoutAuth()
    {
        $this->get("menus/3")
            ->assertStatus(200); // error handled
    }

}
