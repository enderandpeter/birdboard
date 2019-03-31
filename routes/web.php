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

Route::name('projects.')->group(function(){
    Route::prefix('projects')->group(function(){
        Route::post('/', 'ProjectsController@store')->name('store')->middleware('auth');
        Route::get('/', 'ProjectsController@index')->name('index');
        Route::get('/{project}', 'ProjectsController@show')->name('show');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
