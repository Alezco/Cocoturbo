<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Recette;
use App\RecetteType;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use View;
use Session;
Use Redirect;

class RecetteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the nerds
        $recettes = \App\Recette::with('type')->get();
        // load the view and pass the nerds
        return View::make('recettes.index')
            ->with('recettes', $recettes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // get all the nerds
        $types = \App\RecetteType::all();
        $typesName = $types->pluck('type_name');
        return View::make('recettes.create')
            ->with('types', $typesName);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'name'       => 'required',
            'type'      => 'required',
            'image'     => 'nullable'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('recettes/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else if (Recette::where('recettes_name', '=', Input::get('name'))->count() > 0) {
            return Redirect::to('recettes/create')
                ->withErrors('Une recette avec ce nom existe deja')
                ->withInput(Input::except('name'));
        } else {
            // store
            $recette = new \App\Recette();
            $recette->recettes_name = Input::get('name');
            $recette->description = Input::get('description');
            $recette->image_url = Input::get('image');
            $types = \App\RecetteType::all();
            $typesIds = $types->pluck('id');

            $recette->type_id = $typesIds[Input::get('type')];
            $recette->save();

            // redirect
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to('recettes');
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
        // get the nerd
        $recette = Recette::find($id);
        $type = RecetteType::find($recette->type_id);
        $comments = Recette::find($id)->comments()->with('user')->get();
        $favorites = null;
        if (Auth::Check()) {
            $favorites = \App\Favorite::where([
                ['user_id',Auth::user()->id],
                ['recette_id',$id]]
            )->get();
        }
        if ($favorites )
        // show the view and pass the nerd to it
        return View::make('recettes.show')
            ->with('recette', $recette)
            ->with('type', $type)
            ->with('comments', $comments)
            ->with('favorites', $favorites);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // get the nerd
        $recette = Recette::find($id);
        $types = \App\RecetteType::all();
        $typesName = $types->pluck('type_name');
        // show the edit form and pass the nerd
        return View::make('recettes.edit')
            ->with('recette', $recette)
            ->with('types', $typesName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        /// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'type'      => 'required',
            'image'     => 'nullable'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        // process the login
        if ($validator->fails()) {
            return Redirect::to('recettes/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $recette = Recette::find($id);
            $recette->recettes_name = Input::get('name');
            $recette->description = Input::get('description');
            $recette->image_url = Input::get('image');
            $types = \App\RecetteType::all();
            $typesIds = $types->pluck('id');


            $recette->type_id = $typesIds[Input::get('type')];
            $recette->save();

            // redirect
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to('recettes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}