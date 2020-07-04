<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// DB::listen(function($query){
//     dump($query->sql);
// });

// Rutas Recetas y Home
Route::get('/', 'InicioController@index')->name('inicio.index');
Route::resource('receta', 'RecetaController');
Route::get('/buscar', 'RecetaController@search')->name('receta.search');


// Routes profiles
Route::get('/perfiles/{profile}', 'PerfilController@show')->name('profile.show');
Route::get('/perfiles/{profile}/edit', 'PerfilController@edit')->name('profile.edit');
Route::put('/perfiles/{profile}', 'PerfilController@update')->name('profile.update');

// Routes likes of recipes
Route::post('/recetas/{recipe}', 'LikesController@update')->name('likes.store');

Route::get('/categorias/{category}', 'CategoryController@show')->name('category.show');



Auth::routes();

