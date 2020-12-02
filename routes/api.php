<?php

use App\Http\Controllers\ProductController;
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



//Route::apiResource('facture','FactureController');
Route::get('facture/{q?}','FactureController@index' );
Route::POST('facture','FactureController@store' );
Route::PUT('facture/{facture}','FactureController@update' );
Route::get('facture/show/{facture}','FactureController@show' );
Route::delete('facture/deletefile/{facture}','FactureController@deletefile');
Route::delete('facture/{facture}','FactureController@destroy');

//Route::get('facture/edit/{id}','FactureController@edit' );
//Route::get('facture/edit/{id}','FactureController@show');
Route::apiResource('Fournisseur','FrournisseurController');
Route::post('users/register','UsersController@register');
Route::post('users/login','UsersController@login');

//Route::apiResource('produit','ProductController');
//Route::post('produit','ProductController@store');
Route::post('produit','ProductController@store' );
//Route::get('produit','ProductController@index' );
Route::get('produit','ProductController@index' );
//Route::get('produit/{id}','ProductController@show' );
Route::get('produit/show/{product}','ProductController@show' );
Route::PUT('produit/{product}','ProductController@update');

Route::delete('produit/{product}','ProductController@destroy');

Route::get('commande/commande_produit/{commande}','CommandeController@Produit_commande' );
Route::delete('produit/supproduit/{product}','ProductController@supp_produit_decharge');
Route::get('produit/addbon','ProductController@addbon');







//Route::PUT('product/{id}','ProductController@update');
Route::apiResource('budget','BudgetController');

Route::get('commande','CommandeController@index' );
Route::post('commande','CommandeController@store' );



Route::get('structure','StructureController@index' );

