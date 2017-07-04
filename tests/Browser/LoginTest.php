<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'user1@email.com')
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('/recettes');
        });
    }
}
