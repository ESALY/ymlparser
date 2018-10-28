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
    return view('home');
});

Route::get('/import', function () {
    return view('import');
});

Route::get('/id/{id}',['uses' =>'ItemsController@item_get']);

Route::post('/items/get',['uses' =>'ItemsController@items_get']);
Route::get('/import-debug', 'ImportsController@test_import');
Route::get('/debug2', 'ItemsController@items_get2');
