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



Route::apiResource('facture','FactureController');
//Route::get('facture/edit/{id}','FactureController@show');
Route::apiResource('Fournisseur','FrournisseurController');
Route::post('users/register','UsersController@register');
Route::post('users/login','UsersController@login');

//Route::apiResource('produit','ProductController');
//Route::post('produit','ProductController@store');
Route::apiResource('produit','ProductController');
Route::apiResource('budget','BudgetController');
