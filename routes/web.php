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
    return view('welcome');
});

Route::group(['pl'], function() {
    Route::get('/headerpl/{idpl}', 'HeaderPlController@index');
});

Route::group(['detailpl'], function() {
    Route::get('/detailpl/{idpl}', 'DetailPlController@index');
});

//json
Route::group(['data_pl'], function() {
    Route::get('/pl/{idpl}', 'PLController@index');
    Route::get('/harga/{idpl}', 'HargaController@index');
    Route::get('/detail/{idpl}', 'DetailController@index');
});
