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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/got', 'ListController@show')->middleware('auth');


Route::resource('/recettes', 'RecetteController');
Route::get('/recettes/create', 'RecetteController@create')->middleware('auth');
Route::get('/recettes/edit', 'RecetteController@edit')->middleware('auth');

Route::get('/favorite', 'FavoriteController@index')->middleware('auth');
Route::post('/favorite/create', array('uses' => 'FavoriteController@store'))->middleware('auth');
Route::delete('/favorite/delete/{id}', array('uses' => 'FavoriteController@destroy'))->middleware('auth');

Route::resource('/menus', 'MenusController');
Route::get('/menus', 'MenusController@index')->middleware('auth');
Route::get('/menus/create', 'MenusController@create')->middleware('auth');
Route::delete('/menus/delete/{id}', array('uses' => 'MenusController@destroy'))->middleware('auth');

Route::resource('/comments', 'CommentController');

Route::post('/comments/create', array('uses' => 'CommentController@store'));