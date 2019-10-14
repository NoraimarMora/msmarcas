<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\DB;

$router->get('/', function () use ($router) {
    return "Microservicio Marcas";
});

$router->get('/liveness', function () use ($router) {
    return "Microservicio Marcas";
});

$router->get('/readiness', function () use ($router) {
    return DB::table('migrations')->get();
});

$router->group(['prefix' => 'marcas'], function () use ($router) {
    $router->get('/', 'MarcaController@getAll');
    $router->get('/active', 'MarcaController@getActive');
    $router->get('/{marca}', 'MarcaController@getById');
    $router->get('/{marca}/tiendas', 'MarcaController@getTiendasByMarcaId');
    $router->post('/', 'MarcaController@store');
    $router->put('/{marca}', 'MarcaController@update');
    $router->delete('/{marca}', 'MarcaController@destroy');
});

$router->group(['prefix' => 'tiendas'], function () use ($router) {
    $router->get('/', 'TiendaController@getAll');
    $router->get('/active', 'TiendaController@getActive');
    $router->get('/{tienda}', 'TiendaController@getById');
    $router->get('/{tienda}/cuentas', 'TiendaController@getCuentasByTiendaId');
    $router->get('/{tienda}/horarios', 'TiendaController@getHorariosByTiendaId');
    $router->post('/', 'TiendaController@store');
    $router->put('/{tienda}', 'TiendaController@update');
    $router->delete('/{tienda}', 'TiendaController@destroy');
});

$router->group(['prefix' => 'horarios'], function () use ($router) {
    $router->get('/{horario}', 'HorarioController@getById');
    $router->post('/', 'HorarioController@store');
    $router->put('/{horario}', 'HorarioController@update');
    $router->delete('/{horario}', 'HorarioController@destroy');
});

$router->group(['prefix' => 'cuentas'], function () use ($router) {
    $router->get('/{cuenta}', 'CuentaBancariaController@getById');
    $router->post('/', 'CuentaBancariaController@store');
    $router->put('/{cuenta}', 'CuentaBancariaController@update');
    $router->delete('/{cuenta}', 'CuentaBancariaController@destroy');
});