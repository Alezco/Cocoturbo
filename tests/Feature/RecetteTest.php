<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RecetteTest extends TestCase
{
    protected $baseUrl = 'http://localhost:8000';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testConnexion()
    {
        $this->get('/recettes')
            ->assertStatus(200);
    }

    public function testContentSee()
    {
        $this->get('/recettes')
            ->assertSee('Toutes les recettes')
            ->assertStatus(200);
    }

    public function testContentDoNotSee()
    {
        $this->get('/recettes')
            ->assertDontSee('$recettes')
            ->assertStatus(200);
    }
}