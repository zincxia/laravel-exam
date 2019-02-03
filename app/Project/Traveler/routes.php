<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => 'Traveler',
    'namespace' => 'App\\Project\\Traveler\\Controllers',
    'middleware' => [],
], function (Router $router) {
    $router->get('article/getContent', 'ArticleController@getContent');
    $router->resource('index', 'IndexController');
});
