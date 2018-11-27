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

Route::get('/mobile', function () {
    return view('mobile');
});

Route::get('/original2', function () {
    return view('home_original');
});

Route::get('/get-json', function () {
    $arr = array(
        'header' => '4546', 'body' => '888',
    );

    return $arr;
});



Route::post('/items/get',['uses' =>'ItemsController@items_get']);
Route::post('items/import',['uses' =>'ImportsController@importProducts']);
Route::get('/import', function () {
    return view('import');
});

Route::get('/id/{id}',['uses' =>'ItemsController@item_get']);

Route::get('/import-debug', 'ImportsController@test_import');
Route::get('/debug2', 'ItemsController@items_get2');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
