<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Input;
use View;
use Session;
Use Redirect;
use Log;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $rules = array(
            'content'       => 'required|max:191',
            'user_id'      => 'required',
            'recette_id'     => 'required',
            'rating'        => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('recettes/'.Input::get('recette_id'))
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $comment = new \App\Comment();
            $comment->comment_content = Input::get('content');
            $comment->user_id = Input::get('user_id');
            $comment->recette_id = Input::get('recette_id');
            $comment->rating = Input::get('rating');
            $comment->save();

            // redirect
            Session::flash('message', 'Commentaire posté avec succès !');
            return Redirect::to('recettes/'.Input::get('recette_id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
