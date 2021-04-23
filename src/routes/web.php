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


Route::get('/sql', function () {
    return view('sql');
});


Route::get('/convert-eloquent-to-sql', 'ConvertorController@convertEloquentToSQL');
Route::post('/convert-eloquent-to-sql', 'ConvertorController@convertEloquentToSQL');

