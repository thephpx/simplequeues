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


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->options('/api/token/update/{id}',['uses'=>'TokenController@cors']);

$router->get('/api/token', ['uses'=>'TokenController@index']);
$router->get('/api/token/get/{id}', ['uses'=>'TokenController@read']);
$router->get('/api/token/byagent/{agent_id}', ['uses'=>'TokenController@byagent']);
$router->get('/api/token/bystation/{station_id}', ['uses'=>'TokenController@bystation']);
$router->post('/api/token/create', ['uses'=>'TokenController@create']);
$router->post('/api/token/request', ['uses'=>'TokenController@request']);
$router->put('/api/token/update/{id}', ['uses'=>'TokenController@update']);
$router->delete('/api/token/delete/{id}', ['uses'=>'TokenController@delete']);


$router->get('/api/station', ['uses'=>'StationController@index']);
$router->get('/api/station/get/{id}', ['uses'=>'StationController@read']);
$router->post('/api/station/create', ['uses'=>'StationController@create']);
$router->put('/api/station/update/{id}', ['uses'=>'StationController@update']);
$router->delete('/api/station/delete/{id}', ['uses'=>'StationController@delete']);