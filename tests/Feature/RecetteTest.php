<?php

namespace Tests\Feature;

use App\Http\Controllers\RecetteController;
use App\Recette;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RecetteTest extends TestCase
{
    public function testDatabaseHas()
    {
        $this->assertDatabaseHas('recettes', [
            'recettes_name' => 'Cake au légume'
        ]);
    }

    public function testMissingData()
    {
        $this->assertDatabaseMissing('recettes', [
            'recettes_name' => 'Salade de poulet'
        ]);
    }

    public function testRecette()
    {
    }
}
