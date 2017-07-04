<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Webmozart\Assert\Assert;


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

        $this->assertDatabaseHas('users', [
            'name' => 'coco',
            'email' => 'coco@coco.fr'
        ]);
    }


    public function testCreateUserSameEmail()
    {
        try {
            $u1 = \App\User::create(array(
                'name' => 'coco',
                'email' => 'coco@coco.fr',
                'password' => bcrypt('password'),
            ));

            $u2 = \App\User::create(array(
                'name' => 'coco',
                'email' => 'coco@coco.fr',
                'password' => bcrypt('password'),
            ));
        }
        catch(\Illuminate\Database\QueryException $ex){
            $this->assertContains('coco@coco.fr', $ex->getMessage());
            return;
        }
        $this->assertFalse(true);
    }
}
