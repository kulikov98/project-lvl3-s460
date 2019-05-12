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

$router->get('/', [
    'as' => 'home', 'uses' => 'HomeController@show'
]);

$router->post('/domains', [
    'as' => 'addDomain', 'uses' => 'DomainsController@add'
]);

$router->get('/domains/{id}', [
    'as' => 'showDomains', 'uses' => 'DomainsController@show'
]);
