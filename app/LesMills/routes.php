<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => 'lesmille',
    'namespace' => 'App\\Lesmille\\Controllers',
    'middleware' => [],
], function (Router $router) {
    $router->resource('index', 'IndexController');
});
