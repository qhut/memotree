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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () { return view('welcome'); })->middleware('auth');
    Route::resource('/tasks', 'TasksController');
    Route::resource('/notes', 'NotesController');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/message/{id}', 'HomeController@getMessage')->name('message');
    Route::post('message', 'HomeController@sendMessage');
});


