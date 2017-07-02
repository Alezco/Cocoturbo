<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use View;
use Session;
Use Redirect;
use Illuminate\Support\Facades\Input;
use App\RecetteType;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $menus = \App\Menu::with(['entree','plat','dessert'])->get();
        // load the view and pass the nerds
        return View::make('menus.index')
            ->with('menus', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $recettes = \App\Recette::select('type_id', 'recettes_name', 'id')->groupBy('type_id', 'recettes_name', 'id')->get();
        $array = array();
        $history = array();
        foreach ($recettes as $recette){
            $subArray = array();
            $type = RecetteType::find($recette->type_id);
            if (in_array($type, $history)) {
                continue;
            }
            array_push($history, $type);
            foreach ($recettes as $re) {
                if ($re->type_id == $type->id) {
                    array_push($subArray, $re);
                }
            }
            array_push($array, $subArray);
        }
        $rec = $array;
        $entree = array_pluck($rec[0], 'recettes_name');
        $plat = array_pluck($rec[1],'recettes_name');
        $dessert = array_pluck($rec[2],'recettes_name');
        return View::make('menus.create')
            ->with('recettes', $rec)
            ->with('entrees', $entree)
            ->with('plats', $plat)
            ->with('desserts', $dessert);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'user_id'       => 'required',
            'entree'        => 'required',
            'plat'          => 'required',
            'dessert'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        // process the login
        if ($validator->fails()) {
            return Redirect::to('menus/create')
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

    }
}
