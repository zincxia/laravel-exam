<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => 'Est',
    'namespace' => 'App\\Est\\Controllers',
    'middleware' => [],
], function (Router $router) {
    $router->resource('index', 'IndexController');
});
