<?php

namespace App\Http\Controllers;

use App\Recette;

class ListRecettesController extends Controller
{
    public function show()
    {
        $recettes = Recette::all();

        return view('recettes')->withRecettes($recettes);
    }
}
