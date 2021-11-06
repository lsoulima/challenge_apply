<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Les routes de gestion du panier
Route::get('panier', "ProductController@showAll");
Route::get('panier/{id}', "ProductController@showProduct");
Route::post('panier/add', "ProductController@add");
Route::delete('panier/remove/{id}', "ProductController@remove");

// Les routes de gestion de categorie
Route::get('categories', "CategoryController@showAll");
Route::get('category/{id}', "CategoryController@showCategory");
Route::post('category/add', "CategoryController@add");
Route::delete('category/remove/{id}', "CategoryController@remove");