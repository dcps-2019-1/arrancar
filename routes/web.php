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
Route::get('/conductor', 'ConductorController@index')->name('conductor');
Route::get('/empresa', 'EmpresaController@index')->name('empresa');
//Route::get('/home', 'HomeController@index')->name('home');
