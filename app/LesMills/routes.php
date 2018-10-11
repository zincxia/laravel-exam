<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => 'LesMills',
    'namespace' => 'App\\LesMills\\Controllers',
    'middleware' => [],
], function (Router $router) {
    $router->resource('index', 'IndexController');
});
