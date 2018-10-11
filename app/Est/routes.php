<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => 'est',
    'namespace' => 'App\\Est\\Controllers',
    'middleware' => [],
], function (Router $router) {
    $router->resource('index', 'IndexController');
});
