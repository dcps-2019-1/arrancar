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
    if(Auth::check() && Auth::user()->rol == 2)
    {
        return redirect('/empresa');
    }
    if (Auth::check() && Auth::user()->rol == 1) {
        return redirect('/administrador');
    }
    if (Auth::check() && Auth::user()->rol == 0) {
        return redirect('/cliente');
    }
    if (Auth::check() && Auth::user()->rol == 3) {
        return redirect('/conductor');
    }

    return redirect()->route("invitado");
});
//invitado
Route::get('/invitado', 'invitadoController@index')->name('invitado');
Route::post('invitado/consultar/fetch2', 'invitadoController@fetch')->name("invitadocontroller.fetch");
Route::post('invitado/consultar', 'invitadoController@consulta')->name("consulta_invitado");



Auth::routes();
Route::get('/login', function (){return view('auth.login');})->name("login");
Route::get('/register', function (){return view('auth.register');})->name("register");

Route::get('/administrador', 'AdministradorController@index')->name('administrador')->middleware('auth', 'rol:1');

//conductor

Route::get('/conductor/consultar-viajes', 'ConductorController@consultaViajes')->name('consulta_viajes')->middleware('auth', 'rol:3');

//
Route::get('/cliente', "ClienteController@index")->name('cliente')->middleware('auth', 'rol:0');

Route::get('/empresa', 'EmpresaController@index')->name('empresa')->middleware('auth', 'rol:2');

//Dos urls para la misma ruta, una que por defecto lista, la otra para recibir la petición del formulario
Route::get('/empresa/registrar-conductor', 'EmpresaController@vistaRegistrar')->middleware('auth', 'rol:2');
Route::post('/empresa/registrar-conductor', 'EmpresaController@registrarConductores')->name("registro_conductor")->middleware('auth', 'rol:2');

Route::get('/empresa/registrar-bus', 'BusController@vistaRegistrar')->name("listar_buses")->middleware('auth', 'rol:2');
Route::post('/empresa/registrar-bus', 'BusController@registrarBuses')->name("registrar_buses")->middleware('auth', 'rol:2');

Route::get('/empresa/programar-viaje', 'ViajeController@listarRutas')->name("listar_rutas")->middleware('auth', 'rol:2');
Route::post('/empresa/programar-viaje', 'ViajeController@registrarViaje')->name("registrar_viaje")->middleware('auth', 'rol:2');

Route::get('empresa/registrar-ruta', 'RutaController@index')->name('listar_departamentos')->middleware('auth', 'rol:2');
Route::post('empresa/registrar-ruta/fetch2', 'RutaController@fetch')->name('rutacontroller.fetch')->middleware('auth', 'rol:2');
Route::post('empresa/registrar-ruta', 'RutaController@registrarRuta')->name('registrar_ruta')->middleware('auth', 'rol:2');

//perfil del usuario
Route::get('profile', 'UserController@profile')->middleware('auth');
Route::post('profile', 'UserController@update_avatar')->middleware('auth');

//¿¿???
Route::view('/empresa/ListaConductores', 'empresa.ListaConductores')->middleware('auth', 'rol:2');
//Route::view('/empresa/consultar-informacion', 'empresa.consultar-informacion');
Route::get('/empresa/consultar-informacion',"ConsultarController@consultas")->name("consultas")->middleware('auth', 'rol:2');

Route::get('/empresa/ListaMantenimientos', 'ConsultarController@listarMantenimientos')->middleware('auth', 'rol:2');

//listar conductores, listar buses
Route::get('/empresa/ListaConductores', 'ConsultarController@listarConductores')->middleware('auth', 'rol:2');
Route::get('/empresa/ListaBuses', 'ConsultarController@listarBuses')->middleware('auth', 'rol:2');

Route::get('/empresa/ListaRutas', 'ConsultarController@listarRutas')->middleware('auth', 'rol:2');
Route::get('/empresa/ListaViajes', 'ConsultarController@listarViajes')->middleware('auth', 'rol:2');

Route::get('/empresa/programar-mantenimiento', 'MantenimientoController@listar')->name("programar_mantenimiento")->middleware('auth', 'rol:2');
Route::post('/empresa/programar-mantenimiento', 'MantenimientoController@createMantenimiento')->name("create_mantenimiento")->middleware('auth', 'rol:2');

//Route::view('/empresa/consultar-informacion', 'empresa.consultar-informacion');

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de administrador
//registrar empresa
Route::get('/admin/registrar-empresa', 'EmpresaController@registrarEmpresa')->name("registro_empresa")->middleware('auth', 'rol:1');
Route::post('/admin/registrar-empresa', 'EmpresaController@agregarEmpresa')->name("agregar_empresa")->middleware('auth', 'rol:1');
Route::get('/admin/borrar-empresa', 'EmpresaController@borrarEmpresa')->name("borrar_empresa")->middleware('auth', 'rol:1');
Route::delete('/admin/borrar-empresa', 'EmpresaController@borrar')->name("borrado")->middleware('auth', 'rol:1');

//clientes
Route::get('/cliente/consultar', 'clienteController@mostrar')->name("consultar_viaje")->middleware('auth', 'rol:0');
Route::post('/cliente/consultar', 'ClienteController@consulta')->name("consulta")->middleware('auth', 'rol:0');
Route::post('cliente/consultar/fetch2', 'clienteController@fetch')->name("clientecontroller.fetch")->middleware('auth', 'rol:0');
Route::post('cliente/consultar/comprar', 'clienteController@compra')->name("comprar")->middleware('auth', 'rol:0');
Route::post('cliente/consultar/comprar/fin', 'clienteController@finalizarCompra')->name("comprar_fin")->middleware('auth', 'rol:0');

Route::get('/cliente/historial', 'clienteController@historial')->name("historial")->middleware('auth', 'rol:0');
Route::get('/cliente/cancelar', 'clienteController@cancelar')->name("cancelarViaje")->middleware('auth', 'rol:0');
route::get("cliente/cancelar/{idtiquete}","clienteController@cancelarViaje")->name("cancelar_ya")->middleware('auth', 'rol:0');

