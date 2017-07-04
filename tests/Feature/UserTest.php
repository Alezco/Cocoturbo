<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegistePath()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testConnexionPath()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
