<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class createUserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUserTest()
    {
        $u1 = \App\User::create(array(
            'name' => 'coco',
            'email' => 'coco@coco.fr',
            'password' => bcrypt('password'),
        ));

        $u1->push();

        $this->assertDatabaseHas('users', [
            'name' => 'coco',
            'email' => 'coco@coco.fr'
        ]);
    }
}
