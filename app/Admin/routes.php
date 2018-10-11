<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->post('exam/grid/import', 'ExamGridController@import');
    $router->resource('exam/grid', 'ExamGridController')->only(['index', 'create', 'store', 'update', 'edit']);
    $router->resource('exam/form/', 'ExamFormController');
    $router->resource('exam/content/', 'ExampleContentController');
    $router->resource('questionnaire', 'QuestionnaireController')->only(['index', 'create', 'store', 'update', 'edit']);
    $router->resource('questionDictionary', 'QuestionDictionaryController')->only(['index', 'create', 'store', 'update', 'edit']);
    $router->get('questionDictionary/child', 'QuestionDictionaryController@child');
    $router->get('geoTable', 'LbsCloudBaiduController@geoTable');


    //LesMills
    $router->resource('LesMills/tech', 'LesMills\TechniqueController')->only(['index', 'create', 'store', 'update', 'edit']);
});
