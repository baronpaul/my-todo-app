<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos', 'TodosController@index');

Route::get('/todos/{id}', 'TodosController@show');

Route::post('/todos/store', 'TodosController@store');

Route::post('/todos/update/{id}', 'TodosController@update');

Route::delete('/todos/delete/{id}', 'TodosController@destroy');

Route::post('/todos/deleteall', 'TodosController@deleteall');

