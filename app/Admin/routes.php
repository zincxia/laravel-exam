<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('exam/grid', 'ExamGridController')->only(['index', 'create', 'store', 'update', 'edit']);
    $router->resource('exam/form/', 'ExamFormController');
    $router->resource('questionnaire', 'Questionnaire');

});
