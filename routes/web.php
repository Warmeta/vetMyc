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
    return View::make('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Laboratory

Route::get('/lab', 'LaboratoryController@index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('lab/create', [
        'uses' => 'LaboratoryController@create',
        'as' => 'clinicCase.create'
    ]);
    Route::post('lab/create', [
        'uses' => 'LaboratoryController@store',
        'as' => 'clinicCase.post'
    ]);
});