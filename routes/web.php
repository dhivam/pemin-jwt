<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['middleware' => 'jwt.auth'],function () use ($router){

    $router->get('users/{id}', 'AuthController@show');
    $router->put('users/{id}', 'AuthController@update');
    $router->delete('users/{id}', 'AuthController@delete');
    $router->post('auth/register', 'AuthController@register');

    $router->get('film', 'FilmController@index');
    $router->get('film/{id}', 'FilmController@getFilmbyId');
    $router->post('film', 'FilmController@FilmStore');
    $router->put('film/{id}', 'FilmController@FilmUpdate');
    $router->delete('film/{id}', 'FilmController@FilmDestroy');


});

