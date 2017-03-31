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

use App\Http\Middleware\CheckPermission;

Route::get('/', function () {
    return View::make('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index');


//Laboratory

Route::get('/lab', [
    'uses' => 'LaboratoryController@index',
    'as' => 'lab'
]);

Route::group(['prefix' => 'lab',  'middleware' => 'auth'], function () {

    //Clinic cases
    Route::get('clinic-case', ['uses' => 'LaboratoryController@indexC', 'as' => 'clinicCase.index'])->middleware('checkPermission:browse_clinic_case');

    Route::get('clinic-case/create', ['uses' => 'LaboratoryController@create', 'as' => 'clinicCase.create'])->middleware('checkPermission:browse_clinic_case');

    Route::get('clinic-case/{id}/edit', ['uses' => 'LaboratoryController@edit', 'as' => 'clinicCase.edit'], function ($id) {
    //
    })->where('id', '[0-9]+')->middleware('checkPermission:browse_clinic_case');

    Route::get('clinic-case/{id}', ['uses' => 'LaboratoryController@show', 'as' => 'clinicCase.show'], function ($id) {
    //
    })->where('id', '[0-9]+')->middleware('checkPermission:browse_clinic_case');

    Route::post('clinic-case/create', ['uses' => 'LaboratoryController@store', 'as' => 'clinicCase.post'])->middleware('checkPermission:browse_clinic_case');

    Route::delete('clinic-case/delete/{id}', ['uses' => 'LaboratoryController@destroy', 'as' => 'clinicCase.delete'])->where('id', '[0-9]+')->middleware('checkPermission:browse_clinic_case');
});