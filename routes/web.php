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
    //Clinic cases
    Route::get('lab/clinic-case', [
        'uses' => 'LaboratoryController@indexC',
        'as' => 'clinicCase.index'
    ]);
    Route::get('lab/clinic-case/create', [
        'uses' => 'LaboratoryController@create',
        'as' => 'clinicCase.create'
    ]);
    Route::get('lab/clinic-case/{id}/edit', [
        'uses' => 'LaboratoryController@edit',
        'as' => 'clinicCase.edit'
    ], function ($id) {
        //
    })->where('id', '[0-9]+');

    Route::get('lab/clinic-case/{id}', [
        'uses' => 'LaboratoryController@show',
        'as' => 'clinicCase.show'
    ], function ($id) {
        //
    })->where('id', '[0-9]+');


    Route::post('lab/clinic-case/create', [
        'uses' => 'LaboratoryController@store',
        'as' => 'clinicCase.post'
    ]);
});