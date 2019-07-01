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
Route::get('/empresa', 'EmpresaController@index')->name('empresa')->middleware('auth', 'rol:2');

//Dos urls para la misma ruta, una que por defecto lista, la otra para recibir la petición del formulario
Route::get('/empresa/registrar-conductor', 'EmpresaController@vistaRegistrar')->middleware('auth', 'rol:2');
Route::post('/empresa/registrar-conductor', 'EmpresaController@registrarConductores')->name("registro_conductor")->middleware('auth', 'rol:2');

Route::get('/empresa/registrar-bus', 'BusController@vistaRegistrar')->name("listar_buses")->middleware('auth', 'rol:2');
Route::post('/empresa/registrar-bus', 'BusController@registrarBuses')->name("registrar_buses")->middleware('auth', 'rol:2');

Route::view('/empresa/programar-viaje', 'empresa.programar-viaje');

Route::get('empresa/registrar-ruta', 'RutaController@index')->name('listar_departamentos')->middleware('auth', 'rol:2');
Route::post('empresa/registrar-ruta/fetch2', 'RutaController@fetch')->name('rutacontroller.fetch')->middleware('auth', 'rol:2');
Route::post('empresa/registrar-ruta', 'RutaController@registrarRuta')->name('registrar_ruta')->middleware('auth', 'rol:2');

Route::view('/empresa/programar-mantenimiento', 'empresa.programar-mantenimiento');

Route::view('/empresa/consultar-informacion', 'empresa.consultar-informacion');
//Route::get('/home', 'HomeController@index')->name('home');
