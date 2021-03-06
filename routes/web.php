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

Route::get('/home', 'HomeController@index');

Route::get('/', function () {
    return View::make('welcome');
});

Route::post('/contact', 'HomeController@contact');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});




//Laboratory

Route::get('/lab', [
    'uses' => 'LaboratoryController@index',
    'as' => 'lab'
]);

//Auth Route

Auth::routes();

//Research routes

Route::get('/team', function () {
    return View::make('research.team');
});
Route::get('/projects', [
    'uses' => 'HomeController@indexProjects',
    'as' => 'research.projects'
]);
Route::get('/publications', [
    'uses' => 'HomeController@indexPublications',
    'as' => 'research.publications'
]);
Route::get('/tfg', [
    'uses' => 'HomeController@indexTfg',
    'as' => 'research.tfg'
]);
Route::get('/tpg', [
    'uses' => 'HomeController@indexTpg',
    'as' => 'research.tpg'
]);
Route::get('/tesis', [
    'uses' => 'HomeController@indexTesis',
    'as' => 'research.tesis'
]);
Route::get('/congresos', [
    'uses' => 'HomeController@indexCongresos',
    'as' => 'research.congresos'
]);
Route::get('/proj', [
    'uses' => 'HomeController@indexProj',
    'as' => 'research.proj'
]);

//Mycology

Route::group(['prefix' => 'mycology'], function () {

    Route::get('/dimorficos', function () {
        return View::make('mycology.dimorficos');
    });

    Route::get('/aspergilosis', function () {
        return View::make('mycology.aspergilosis');
    });

    Route::get('/dermatofitosis', function () {
        return View::make('mycology.dermatofitosis');
    });

    Route::get('/generalidades', function () {
        return View::make('mycology.generalidades');
    });

    Route::get('/candidiasis', function () {
        return View::make('mycology.candidiasis');
    });

    Route::get('/criptococosis', function () {
        return View::make('mycology.criptococosis');
    });

    Route::get('/malassezias', function () {
        return View::make('mycology.malassezias');
    });
});

//Project Manager


Route::group(['prefix' => 'project-manager'], function () {

    Route::get('/', [
        'uses' => 'ProjectController@index',
        'as' => 'projectManager.index'
    ])->middleware('checkPermission:browse_projects');

    Route::get('create', ['uses' => 'ProjectController@create', 'as' => 'project.create'])->middleware('checkPermission:add_projects');

    Route::post('create', ['uses' => 'ProjectController@store', 'as' => 'project.post'])->middleware('checkPermission:add_projects');

    Route::get('{id}', ['uses' => 'ProjectController@show', 'as' => 'projectManager.show'], function ($id) {
    //
    })->where('id', '[0-9]+');

    Route::get('{id}/edit', ['uses' => 'ProjectController@edit', 'as' => 'projectManager.edit'], function ($id) {
    //
  })->where('id', '[0-9]+')->middleware('checkPermission:edit_projects');

    Route::put('{id}/edit', ['uses' => 'ProjectController@update', 'as' => 'projectManager.update'], function ($id) {
        //
    })->where('id', '[0-9]+')->middleware('checkPermission:edit_projects');

    Route::delete('delete/{id}', ['uses' => 'ProjectController@destroy', 'as' => 'projectManager.delete'])->where('id', '[0-9]+')->middleware('checkPermission:delete_projects');

});

//Laboratory

Route::group(['prefix' => 'lab'], function () {



    //Email
    Route::get('/email/{id}', ['uses' => 'LaboratoryController@email', 'as' => 'sendEmail'], function ($id) {
        //
    })->where('id', '[0-9]+')->middleware('checkPermission:browse_clinic_cases');

    //Clinic cases
    Route::get('clinic-case', ['uses' => 'LaboratoryController@indexC', 'as' => 'clinicCase.index'])->middleware('checkPermission:browse_clinic_cases');

   // Route::get('clinic-case-filter', ['uses' => 'LaboratoryController@indexFilter', 'as' => 'clinicCase.filter'])->middleware('checkPermission:browse_clinic_cases');

    Route::get('clinic-case/create', ['uses' => 'LaboratoryController@create', 'as' => 'clinicCase.create'])->middleware('checkPermission:add_clinic_cases');

    Route::post('clinic-case/create', ['uses' => 'LaboratoryController@store', 'as' => 'clinicCase.post'])->middleware('checkPermission:add_clinic_cases');

    Route::get('clinic-case/{id}/edit', ['uses' => 'LaboratoryController@edit', 'as' => 'clinicCase.edit'], function ($id) {
    //
  })->where('id', '[0-9]+')->middleware('checkPermission:edit_clinic_cases');

    Route::put('clinic-case/{id}/edit', ['uses' => 'LaboratoryController@update', 'as' => 'clinicCase.update'], function ($id) {
        //
    })->where('id', '[0-9]+')->middleware('checkPermission:edit_clinic_cases');

    Route::get('clinic-case/{id}', ['uses' => 'LaboratoryController@show', 'as' => 'clinicCase.show'], function ($id) {
    //
  })->where('id', '[0-9]+')->middleware('checkPermission:read_clinic_cases');


    Route::delete('clinic-case/delete/{id}', ['uses' => 'LaboratoryController@destroy', 'as' => 'clinicCase.delete'])->where('id', '[0-9]+')->middleware('checkPermission:delete_clinic_cases');

    //Antibiotics
    Route::get('antibiotic', ['uses' => 'LaboratoryController@indexA', 'as' => 'antibiotic.index'])->middleware('checkPermission:browse_antibiotics');

    Route::get('antibiotic/create', ['uses' => 'LaboratoryController@createAntibiotic', 'as' => 'antibiotic.create'])->middleware('checkPermission:add_antibiotics');

    Route::get('antibiotic/{id}/edit', ['uses' => 'LaboratoryController@editAntibiotic', 'as' => 'antibiotic.edit'], function ($id) {
        //
    })->where('id', '[0-9]+')->middleware('checkPermission:edit_antibiotics');

    Route::put('antibiotic/{id}/edit', ['uses' => 'LaboratoryController@updateAntibiotic', 'as' => 'antibiotic.update'], function ($id) {
        //
    })->where('id', '[0-9]+')->middleware('checkPermission:edit_antibiotics');

    Route::get('antibiotic/{id}', ['uses' => 'LaboratoryController@showAntibiotic', 'as' => 'antibiotic.show'], function ($id) {
        //
    })->where('id', '[0-9]+')->middleware('checkPermission:read_antibiotics');

    Route::post('antibiotic/create', ['uses' => 'LaboratoryController@storeAntibiotic', 'as' => 'antibiotic.post'])->middleware('checkPermission:add_antibiotics');

    Route::delete('antibiotic/delete/{id}', ['uses' => 'LaboratoryController@destroyAntibiotic', 'as' => 'antibiotic.delete'])->where('id', '[0-9]+')->middleware('checkPermission:delete_antibiotics');

});
