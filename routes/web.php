<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/recettes');
});

Route::get('home', function () {
    return redirect('/recettes');
});

Auth::routes();

Route::get('/got', 'ListController@show')->middleware('auth');


Route::resource('/recettes', 'RecetteController');
Route::get('/recettes/create', 'RecetteController@create')->middleware('auth');
Route::get('/recettes/edit', 'RecetteController@edit')->middleware('auth');

Route::get('/favorite', 'FavoriteController@index')->middleware('auth');
Route::post('/favorite/create', array('uses' => 'FavoriteController@store'));
Route::delete('/favorite/delete/{id}', array('uses' => 'FavoriteController@destroy'))->middleware('auth');

Route::resource('/menu', 'MenusController');
Route::get('/menu', 'MenusController@index')->middleware('auth');
Route::get('/menu/{id}', array('middleware' => 'auth', 'uses' => 'MenusController@show'));
Route::get('/menu/create', 'MenusController@create')->middleware('auth');
Route::delete('/menu/delete/{id}', array('middleware' => 'auth', 'uses' => 'MenusController@destroy'))->middleware('auth');

Route::resource('/comments', 'CommentController');

Route::post('/comments/create', array('uses' => 'CommentController@store'));