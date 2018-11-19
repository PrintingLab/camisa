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
Route::post('enpoints', 'ApicallsController@GetCalls')->name('enpoints');
Route::post('GetCategories', 'ApicallsController@GetCategories')->name('GetCategories');
Route::post('cotizar', 'ApicallsController@callcotizar')->name('cotizar');

Route::post('getquote', 'ApicallsController@callgetquote')->name('getquote');
