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

$router->get('/', 'PuisiController@index');

$router->group(['prefix' => 'puisi'], function () use ($router)
{
    $router->post('tambah-puisi', 'PuisiController@tambahPuisi');
    $router->post('update-puisi/{id}', 'PuisiController@updatePuisi');
    $router->get('daftar-puisi', 'PuisiController@dataPuisi');
    $router->get('edit-puisi/{id}', 'PuisiController@ubahPuisi');
    $router->post('hapus-puisi/{id}', 'PuisiController@deletePuisi');
});

$router->group(['prefix' => 'auth'], function () use ($router)
{
    $router->post("/register", "AuthController@register");
    $router->post("/login", "AuthController@login");
});