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

$router->group(['prefix' => 'api'],function ($router){
    $router->get('books','BookController@showAllBooks');
    $router->get('books/{id}','BookController@findBook');
    $router->get('search/books/{title}','BookController@findBookByTitle');
    $router->put('update/books/{id}','BookController@update');

});
