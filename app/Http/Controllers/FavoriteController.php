<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Support\Facades\Auth;
use Validator;
use View;
use Session;
Use Redirect;
use Illuminate\Support\Facades\Input;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the nerds
        $favorites = \App\Favorite::where('user_id', Auth::user()->id)->get();
        // load the view and pass the nerds
        return View::make('favorites.index')
            ->with('recettes', $favorites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'user_id'      => 'required',
            'recette_id'     => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('recettes/'.Input::get('recette_id'))
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $favorite = new \App\Favorite();
            $favorite->user_id = Input::get('user_id');
            $favorite->recette_id = Input::get('recette_id');
            $favorite->save();

            // redirect
            Session::flash('message', 'Favori créé avec succès !');
            return Redirect::to('recettes/'.Input::get('recette_id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $fav = Favorite::find($id);
        $fav->delete();

        // redirect
        Session::flash('message', 'Favori supprimé avec succès');
        return Redirect::to('favorite');
    }
}
