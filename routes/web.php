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



Auth::routes();
Route::get('/login', function (){return view('auth.login');})->name("login");
Route::get('/register', function (){return view('auth.register');})->name("register");

Route::get('/conductor', 'ConductorController@index')->name('conductor');
Route::get('/empresa', 'EmpresaController@index')->name('empresa');

//Dos urls para la misma ruta, una que por defecto lista, la otra para recibir la petición del formulario
Route::get('/empresa/registrar-conductor', 'EmpresaController@listarConductores');
Route::post('/empresa/registrar-conductor', 'EmpresaController@registrarConductores')->name("registro_conductor");

Route::get('/empresa/registrar-bus', 'BusController@listarBuses')->name("listar_buses");
Route::post('/empresa/registrar-bus', 'BusController@registrarBuses')->name("registrar_buses");

Route::view('/empresa/programar-viaje', 'empresa.programar-viaje');

Route::view('/empresa/registrar-ruta', 'empresa.registrar-ruta');

Route::view('/empresa/programar-mantenimiento', 'empresa.programar-mantenimiento');
Route::view('/empresa/ListaConductores', 'empresa.ListaConductores');
Route::view('/empresa/consultar-informacion', 'empresa.consultar-informacion');

Route::view('/empresa/ListaBuses', 'empresa.ListaBuses');


Route::get('/empresa/ListaConductores', 'ConsultarController@listarConductores');
Route::get('/empresa/ListaBuses', 'ConsultarController@listarBuses');

//Route::get('/home', 'HomeController@index')->name('home');

