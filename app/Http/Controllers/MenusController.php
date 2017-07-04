<?php

namespace App\Http\Controllers;

use App\Menu;
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
        $menus = \App\Menu::with(['entree','plat','dessert'])->where('user_id', Auth::user()->id)->get();
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
        // TODO REFACTOR
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
        $rules = array(
            'user_id'       => 'required',
            'entree'        => 'required',
            'plat'          => 'required',
            'dessert'       => 'required',
            'menu_title'    => 'required|max:191|unique:menus'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('menus/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            // TODO REFACTOR
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
            $entree = array_pluck($rec[0], 'id');
            $plat = array_pluck($rec[1],'id');
            $dessert = array_pluck($rec[2],'id');


            // store
            $menu = new \App\Menu();
            $menu->menu_title = Input::get('menu_title');
            $menu->user_id = Input::get('user_id');
            $menu->entree_id = $entree[Input::get('entree')];
            $menu->plat_id = $plat[Input::get('plat')];
            $menu->dessert_id = $dessert[Input::get('dessert')];

            $menu->save();

            // redirect
            Session::flash('message', 'Menu créé avec succès !');
            return Redirect::to('menus');
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
        try {
            $tmp = Menu::find($id);
            if ($tmp == null) {
                return View::make('errors.404');
            }
        }
        catch(\Exception $e){
            return View::make('errors.404');
        }
        $menus = Menu::with(['entree', 'plat', 'dessert'])->where([
            ['user_id', Auth::user()->id],
            ['id', $id]])->get();

        return View::make('menus.show')
            ->with('menu', $menus);
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
        $fav = Menu::find($id);
        $fav->delete();

        // redirect
        Session::flash('message', 'Menu supprimé avec succès !');
        return Redirect::to('menus');
    }
}
