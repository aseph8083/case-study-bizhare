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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

$router->group(['prefix' => 'master'], function () use ($router) {
    $router->group(['prefix' => 'article'], function () use ($router) {
        $router->get('/', 'ArticlesController@index');
        $router->get('/{id}', 'ArticlesController@detail');
        $router->get('/category/{id}', 'ArticlesController@show');
        $router->post('/insert', 'ArticlesController@store');
        $router->put('/update/{id}', 'ArticlesController@update');
        $router->delete('/delete/{id}', 'ArticlesController@destroy');
    });
    $router->group(['prefix' => 'bantuan'], function () use ($router) {
        $router->get('/', 'BantuansController@index');
        $router->get('/{id}', 'BantuansController@show');
        $router->post('/insert', 'BantuansController@store');
        $router->put('/update/{id}', 'BantuansController@update');
        $router->delete('/delete/{id}', 'BantuansController@destroy');
    });

    $router->group(['prefix' => 'slide'], function () use ($router) {
        $router->get('/', 'SlideController@index');
        $router->get('/{id}', 'SlideController@show');
        $router->post('/insert', 'SlideController@store');
        $router->post('/update/{id}', 'SlideController@update');
        $router->delete('/delete/{id}', 'SlideController@destroy');
    });

    $router->group(['prefix' => 'saldo'], function () use ($router) {
        $router->get('/', 'SaldoController@index');
        $router->get('/{id}', 'SaldoController@show');
    });

    $router->group(['prefix' => 'profile'], function () use ($router) {
        $router->get('/', 'ProfilController@index');
        $router->get('/{id}', 'ProfilController@show');
        $router->put('/ganti-password/{id}', 'ProfilController@changepassword');
        $router->put('/updateprof/{id}', 'ProfilController@updateprof');
    });
});

$router->group(['prefix'=>'admin'], function () use ($router){
    $router->group(['prefix'=>'bisnis'], function () use ($router){
        $router->post('/insert', 'BusinesssController@store');
        $router->put('/update/{id}', 'BusinesssController@update');
        $router->delete('/delete/{id}', 'BusinesssController@destroy');
    });
    $router->group(['prefix'=>'categories'], function () use ($router){
        $router->get('/', 'BusinessCategoriesController@index');
        $router->get('/{id}', 'BusinessCategoriesController@show');
        $router->post('/insert', 'BusinessCategoriesController@store');
        $router->put('/update/{id}', 'BusinessCategoriesController@update');
        $router->delete('/delete/{id}', 'BusinessCategoriesController@destroy');
    });
    $router->group(['prefix'=>'portofolio'], function () use ($router){
        $router->post('/insert', 'PortofolioController@store');
        $router->put('/update/{id}', 'PortofolioController@update');
        $router->delete('/delete/{id}', 'PortofolioController@destroy');
    });
    $router->group(['prefix'=>'investasi'], function () use ($router){
        $router->post('/insert', 'PortofolioTransactionController@store');
        $router->put('/update/{id}', 'PortofolioTransactionController@update');
        $router->delete('/delete/{id}', 'PortofolioTransactionController@destroy');
    });
});

$router->group(['prefix'=>'bisnis'], function () use ($router){
    $router->get('/', 'BusinesssController@index');
    $router->get('/{id}', 'BusinesssController@show');
});

$router->group(['prefix'=>'portofolio'], function () use ($router){
    $router->get('/', 'PortofolioController@index');
    $router->get('/{id}', 'PortofolioController@show');
});

$router->group(['prefix'=>'investasi'], function () use ($router){
    $router->get('/', 'PortofolioTransactionController@index');
    $router->get('/{id}', 'PortofolioTransactionController@show');
});
